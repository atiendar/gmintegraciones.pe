<?php
namespace App\Repositories\almacen\producto;
// Models
use App\Models\Producto;
// Events
use App\Events\layouts\ActividadRegistrada;
use App\Events\layouts\ArchivoCargado;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Repositories
use App\Repositories\papeleraDeReciclaje\PapeleraDeReciclajeRepositories;
use App\Repositories\armado\ArmadoRepositories;
use App\Repositories\servicio\calculo\CalculoRepositories;
// Otros
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
use DB;

class ProductoRepositories implements ProductoInterface {
  protected $serviceCrypt;
  protected $papeleraDeReciclajeRepo;
  protected $armadoRepo;
  protected $calculoRepo;
  public function __construct(ServiceCrypt $serviceCrypt, PapeleraDeReciclajeRepositories $papeleraDeReciclajeRepositories, ArmadoRepositories $armadoRepositories, CalculoRepositories $calculoRepositories) {
    $this->serviceCrypt             = $serviceCrypt;
    $this->papeleraDeReciclajeRepo  = $papeleraDeReciclajeRepositories;
    $this->armadoRepo               = $armadoRepositories;
    $this->calculoRepo              = $calculoRepositories;
  }
  public function productoAsignadoFindOrFailById($id_producto) {
    $id_producto = $this->serviceCrypt->decrypt($id_producto);
    $producto = Producto::with('sustitutos', 'armados', 'proveedores')->asignado(Auth::user()->registros_tab_acces, Auth::user()->email_registro)->findOrFail($id_producto);
    return $producto;
  }
  public function getPagination($request){
    return Producto::with('sustitutos')->asignado(Auth::user()->registros_tab_acces, Auth::user()->email_registro)->buscar($request->opcion_buscador, $request->buscador)->orderBy('id', 'DESC')->paginate($request->paginador);
  }
  public function store($request) {
    try { DB::beginTransaction();
      $producto                  = new Producto();
      $producto->produc          = $request->nombre_del_producto;
      $producto->sku             = $request->sku;
      $producto->marc            = $request->marca;
      $producto->tip             = $request->tipo;
      if($producto->tip == 'Canasta') {
        $producto->alto          = $request->alto;
        $producto->ancho         = $request->ancho;
        $producto->largo         = $request->largo;
        $producto->cost_arm      = $request->costo_de_armado;
      } elseif($producto->tip == 'Producto') {
        $producto->alto          = $this->calculoRepo->bcdivDosDecimales(0.00);
        $producto->ancho         = $this->calculoRepo->bcdivDosDecimales(0.00);
        $producto->largo         = $this->calculoRepo->bcdivDosDecimales(0.00);
        $producto->cost_arm      = $this->calculoRepo->bcdivDosDecimales(0.00);
      }
      $producto->categ           = $request->categoria;
      $producto->etiq            = $request->etiqueta;
      $producto->pes             = $request->peso;
      $producto->cod_barras      = $request->codigo_de_barras;
      $producto->desc_del_prod   = $request->descripcion_del_producto;
      $producto->asignado_prod   = Auth::user()->email_registro;
      $producto->created_at_prod = Auth::user()->email_registro;
      if($request->hasfile('imagen_del_producto')) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        $archivo = ArchivoCargado::dispatch(
          $request->file('imagen_del_producto'), // Archivo blob
          'public/almacen/producto/' . date("Y-m") . '/', // Ruta en la que guardara el archivo
          'producto-' . time() . '.', // Nombre del archivo
          null // Ruta y nombre del archivo anterior
        ); 
        $producto->img_prod_rut  = $archivo[0]['ruta'];
        $producto->img_prod_nom  = $archivo[0]['nombre'];
      }
      $producto->save();
      $this->eliminarCacheAllProductosPlunk();
      DB::commit();
      return $producto;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function update($request, $id_producto) {
    DB::transaction(function() use($request, $id_producto) {  // Ejecuta una transacción para encapsulan todas las consultas y se ejecuten solo si no surgió algún error
      $producto                 = $this->productoAsignadoFindOrFailById($id_producto);
      $producto->produc         = $request->nombre_del_producto;
      $producto->sku            = $request->sku;
      $producto->marc           = $request->marca;
      if($producto->tip == 'Canasta') {
        $producto->alto         = $request->alto;
        $producto->ancho        = $request->ancho;
        $producto->largo        = $request->largo;
        $producto->cost_arm     = $request->costo_de_armado;
      }
      $pivot                    = $producto->proveedores()->where('nom_comerc', $request->nombre_del_proveedor)->first()->pivot;
      $producto->prove          = $request->nombre_del_proveedor;
      $producto->prec_prove     = $pivot->prec_prove;
      $producto->utilid         = $pivot->utilid;
      $prec_clien               = $this->calculoRepo->getUtilidadProducto($pivot->prec_prove, $pivot->utilid, $producto->cost_arm);
      $producto->prec_clien     = $prec_clien;
      $producto->categ          = $request->categoria;
      $producto->etiq           = $request->etiqueta;
      $producto->pes            = $request->peso;
      $producto->cod_barras     = $request->codigo_de_barras;
      $producto->desc_del_prod  = $request->descripcion_del_producto;
      if($producto->isDirty()) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        ActividadRegistrada::dispatch(
          'Productos', // Módulo
          'almacen.producto.show', // Nombre de la ruta
          $id_producto, // Id del registro debe ir encriptado
          $this->serviceCrypt->decrypt($id_producto), // Id del registro a mostrar, este valor no debe sobrepasar los 100 caracteres
          array('Nombre del producto', 'SKU', 'Marca', 'Alto', 'Ancho', 'Largo', 'Costo de armado', 'Nombre del proveedor', 'Precio proveedor', 'Utilidad', 'Precio cliente', 'Categoría', 'Etiqueta', 'Peso', 'Código de barras', 'Descripción del producto'), // Nombre de los inputs del formulario
          $producto, // Request
          array('produc', 'sku', 'marc', 'alto', 'ancho', 'largo', 'cost_arm', 'prove', 'prec_prove', 'utilid', 'prec_clien', 'categ', 'etiq', 'pes', 'cod_barras','desc_del_prod') // Nombre de los campos en la BD
        ); 
        $producto->updated_at_prod = Auth::user()->email_registro;
      }
      if($request->hasfile('imagen_del_producto')) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        $archivo = ArchivoCargado::dispatch(
          $request->file('imagen_del_producto'), // Archivo blob
          'public/almacen/producto/' . date("Y-m") . '/', // Ruta en la que guardara el archivo
          'producto-' . time() . '.', // Nombre del archivo
          $producto->img_prod_rut.$producto->img_prod_nom // Ruta y nombre del archivo anterior
        ); 
        $producto->img_prod_rut  = $archivo[0]['ruta'];
        $producto->img_prod_nom  = $archivo[0]['nombre'];
      }
      $this->armadoRepo->calcularNuevosValoresDelArmado($producto, $producto->getAttribute('alto'), $producto->getAttribute('ancho'), $producto->getAttribute('largo'), $producto->getAttribute('prec_clien'), $producto->getAttribute('pes'));
      $producto->save();
      $this->eliminarCacheAllProductosPlunk();
      return $producto;
    });
  }
  public function aumentarStock($request, $id_producto) {
    $producto = $this->productoAsignadoFindOrFailById($id_producto);
    $producto->stock += $request->aumentar_stock;
    if(strlen($producto->stock) >= 10) {return false;}
    if($producto->isDirty()) {
      // Dispara el evento registrado en App\Providers\EventServiceProvider.php
      ActividadRegistrada::dispatch(
        'Productos', // Módulo
        'almacen.producto.show', // Nombre de la ruta
        $id_producto, // Id del registro debe ir encriptado
        $this->serviceCrypt->decrypt($id_producto), // Id del registro a mostrar, este valor no debe sobrepasar los 100 caracteres
        array('Aumentar stock'), // Nombre de los inputs del formulario
        $producto, // Request
        array('stock') // Nombre de los campos en la BD
      ); 
      $producto->updated_at_prod = Auth::user()->email_registro;
    }
    $producto->save();
    return $producto;
  }
  public function disminuirStock($request, $id_producto) {
    $producto = $this->productoAsignadoFindOrFailById($id_producto);
    $producto->stock -= $request->disminuir_stock;
    if($producto->stock < 0) {return false;}
    if($producto->isDirty()) {
      // Dispara el evento registrado en App\Providers\EventServiceProvider.php
      ActividadRegistrada::dispatch(
        'Productos', // Módulo
        'almacen.producto.show', // Nombre de la ruta
        $id_producto, // Id del registro debe ir encriptado
        $this->serviceCrypt->decrypt($id_producto), // Id del registro a mostrar, este valor no debe sobrepasar los 100 caracteres
        array('Disminuir stock'), // Nombre de los inputs del formulario
        $producto, // Request
        array('stock') // Nombre de los campos en la BD
      ); 
      $producto->updated_at_prod = Auth::user()->email_registro;
    }
    $producto->save();
    return $producto;
  }
  public function destroy($id_producto) {
    try { DB::beginTransaction();
      $producto = $this->productoAsignadoFindOrFailById($id_producto);
      $producto->delete();
      $this->armadoRepo->calcularNuevosValoresDelArmado($producto, $this->calculoRepo->bcdivDosDecimales(0.00), $this->calculoRepo->bcdivDosDecimales(0.00), $this->calculoRepo->bcdivDosDecimales(0.00), $this->calculoRepo->bcdivDosDecimales(0.00), $this->calculoRepo->bcdivTresDecimales(0.000));
      $producto->armados()->detach();
      $this->eliminarCacheAllProductosPlunk();
      // Manda el registro a la papelera de reciclaje
      $this->papeleraDeReciclajeRepo->store([
        'modulo'      => 'Productos', // Nombre del módulo del sistema
        'registro'    => $producto->produc, // Información a mostrar en la papelera
        'tab'         => 'productos', // Nombre de la tabla en la BD
        'id_reg'      => $producto->id, // ID de registro eliminado
        'id_fk'       => null // ID de la llave foranea con la que tiene relación           
      ]);
      DB::commit();
      return $producto;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function getSustitutosProducto($producto, $request) {
    if($request->opcion_buscador != null) {
      return $producto->sustitutos()->with('sustitutos')->where("$request->opcion_buscador", 'LIKE', "%$request->buscador%")->paginate($request->paginador);
    }
    return $producto->sustitutos()->with('sustitutos')->paginate($request->paginador);
  }
  public function getproductoFindOrFailById($id_producto) {
    $id_producto = $this->serviceCrypt->decrypt($id_producto);
    $producto = Producto::with('sustitutos', 'armados', 'proveedores')->findOrFail($id_producto);
    return $producto;
  }
  public function eliminarCacheAllProductosPlunk() {
    Cache::pull('allProductosPlunk'); // Elimina la cache con el nombre espesificado
  }
  public function getAllProductosPlunk() {
    $productos = Cache::rememberForever('allProductosPlunk', function() { // Guarda la información en la cache con la llave "sistema"
      return Producto::orderBy('produc', 'ASC')->pluck('produc', 'id');
    });
    return $productos; 
  }
  // Devuelve todos los registros de la tabla productos a excepción de los que se espesifiquen
  public function getAllSustitutosOrProductosPlunkMenos($sustitutos_o_productos) {
    return Producto::where(function($query) use($sustitutos_o_productos) {
      $hastaC = count($sustitutos_o_productos) -1;
      for($contador2 = 0; $contador2 <= $hastaC; $contador2++) {
        $query->where('id', '!=', $sustitutos_o_productos[$contador2]->id);
      }
    })->orderBy('produc', 'ASC')->pluck('produc', 'id');
  }
  public function getProductosFindOrFail($ids_productos, $hastaC) {
    for($contador2 = 0; $contador2 <= $hastaC; $contador2++) {
      $productos[$contador2] = Producto::select('prec_clien', 'pes', 'alto', 'ancho', 'largo')->where('id', $ids_productos[$contador2])->first();
    }
    return $productos;
  }
  public function getExistenciaEquivalentePorProducto($sustitutos) {
    $existencia_equivalente = 0;
    foreach($sustitutos as $sustituto) {
      $existencia_equivalente += $sustituto->stock;
    }
    return $existencia_equivalente;
  }
  public function getProveedoresProducto($producto, $request) {
    if($request->opcion_buscador != null) {
      return $producto->proveedores()->where("$request->opcion_buscador", 'LIKE', "%$request->buscador%")->paginate($request->paginador);
    }
    return $producto->proveedores()->paginate($request->paginador);
  }
}