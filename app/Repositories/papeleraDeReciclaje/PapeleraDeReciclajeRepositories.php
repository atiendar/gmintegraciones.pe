<?php
namespace App\Repositories\papeleraDeReciclaje;
// Models
use App\Models\PapeleraDeReciclaje;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Repositories
use App\Repositories\papeleraDeReciclaje\tabla\usuarios\UsuariosRepositories;
use App\Repositories\papeleraDeReciclaje\tabla\plantillas\PlantillasRepositories;
use App\Repositories\papeleraDeReciclaje\tabla\proveedores\ProveedoresRepositories;
use App\Repositories\papeleraDeReciclaje\tabla\armados\ArmadosRepositories;
use App\Repositories\papeleraDeReciclaje\tabla\armados\ArmadoTieneImagenesRepositories;
use App\Repositories\papeleraDeReciclaje\tabla\productos\ProductosRepositories;
use App\Repositories\papeleraDeReciclaje\tabla\pedidos\PedidosRepositories;
//Otro
use Illuminate\Support\Facades\Auth;
use DB;

class PapeleraDeReciclajeRepositories implements PapeleraDeReciclajeInterface {
  protected $serviceCrypt;
  protected $usuariosRepo;
  protected $plantillasRepo;
  protected $proveedoresRepo;
  protected $armadosRepo;
  protected $armadoTieneImagenesRepo;
  protected $productosRepo;
  protected $pedidosRepo;
  public function __construct(ServiceCrypt $serviceCrypt, UsuariosRepositories $usuariosRepositories, PlantillasRepositories $plantillasRepositories, ProveedoresRepositories $proveedoresRepositories, ArmadosRepositories $armadosRepositories, ArmadoTieneImagenesRepositories $armadoTieneImagenesRepositories, ProductosRepositories $productosRepositories, PedidosRepositories $pedidosRepositories) {
    $this->serviceCrypt             = $serviceCrypt;
    $this->usuariosRepo             = $usuariosRepositories;
    $this->plantillasRepo           = $plantillasRepositories;
    $this->proveedoresRepo          = $proveedoresRepositories;
    $this->armadosRepo              = $armadosRepositories;
    $this->armadoTieneImagenesRepo  = $armadoTieneImagenesRepositories;
    $this->productosRepo            = $productosRepositories;
    $this->pedidosRepo              = $pedidosRepositories;
  }
  public function papeleraAsignadoFindOrFailById($id_registro) {
    $id_registro = $this->serviceCrypt->decrypt($id_registro);
    $registro = PapeleraDeReciclaje::asignado(Auth::user()->registros_tab_acces, Auth::user()->email_registro)->findOrFail($id_registro);
    return $registro;
  }
  public function getPagination($request) {
    return PapeleraDeReciclaje::asignado(Auth::user()->registros_tab_acces, Auth::user()->email_registro)->buscar($request->opcion_buscador, $request->buscador)->orderBy('id', 'DESC')->paginate($request->paginador);
  }
  public function store($array) {
    $papelera = new PapeleraDeReciclaje();
    $papelera->mod            = $array['modulo'];
    $papelera->reg            = $array['registro'];
    $papelera->tab            = $array['tab'];
    $papelera->id_reg         = $array['id_reg'];
    $papelera->id_fk          = $array['id_fk'];
    $papelera->deleted_at_reg = Auth::user()->email_registro;
    $papelera->save();
    return $papelera;
  }
  public function destroy($id_registro) {
    try { DB::beginTransaction();
      $registro   = $this->papeleraAsignadoFindOrFailById($id_registro);
      $resultado  = $this->tablas($registro, 'destroy');
      $resultado['consulta']->forceDelete();
      $this->destroyAllPapeleraByIdFk($registro->id, $resultado['consulta']->id);
      DB::commit();
      return $registro;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function restore($id_registro) {
    try { DB::beginTransaction();
      $registro = $this->papeleraAsignadoFindOrFailById($id_registro);
      $resultado = $this->tablas($registro, 'restore');
      if($resultado['existe_llave_primaria'] == false) { DB::commit();return false; }
      $resultado['consulta']->restore();
      $this->destroyAllPapeleraByIdFk($registro->id, $resultado['consulta']->id);
      DB::commit();
      return $registro;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function destroyAllPapeleraByIdFk($id_registro, $id_resultado) {
    $registros =  PapeleraDeReciclaje::where('id_fk', $id_resultado)->get();
    if($registros->isEmpty() == false) { // Verifica si la colección esta vacia
      $hastaC = count($registros) - 1;
      for($contador2 = 0; $contador2 <= $hastaC; $contador2++) { 
        $registros_id[$contador2] = $registros[$contador2]->id;        
      }
      array_push($registros_id, $id_registro);
    } else {
      $registros_id[0] = $id_registro;
    }
    PapeleraDeReciclaje::destroy($registros_id); 
  }
  public function tablas($registro, $metodo) {
    $existe_llave_primaria = 'indefinido';
    if($registro->tab == 'users') {
      $consulta = \App\User::withTrashed()->findOrFail($registro->id_reg);
      $this->usuariosRepo->metodo($metodo, $consulta);
      

      /*
      * FALTA ELIMINAR LOSS ARCHIVOS DE ESTOS REGISTROS RELACIONADOS AL USUARIO
      *  'quejasYSugerencias','pedidos', 'pagos', facturas' // LOS PAGOS PUEDEN SALIR DEL PEDIDO VER COMO ES MAS FACIL Y OPTIMO
      */
      if($consulta->acceso == '2') { // 2 = Cliente, 1 = Usuario
        $pedidos = \App\Models\Pedido::with(['armados', 'pagos'])->withTrashed()->where('user_id', $consulta->id)->get();
        foreach($pedidos as $pedido) {
          $this->pedidosRepo->metodo($metodo, $pedido);
        }
      }
      if($consulta->acceso == '1' OR $consulta->acceso == '2') { // 2 = Cliente, 1 = Usuario
      }



    }
    if($registro->tab == 'roles') {
      $consulta = \Spatie\Permission\Models\Role::withTrashed()->findOrFail($registro->id_reg);
    }
    if($registro->tab == 'plantillas') {
      $consulta = \App\Models\Plantilla::withTrashed()->findOrFail($registro->id_reg);
      $this->plantillasRepo->metodo($metodo, $consulta);
    }
    if($registro->tab == 'catalogos') {
      $consulta = \App\Models\Catalogo::withTrashed()->findOrFail($registro->id_reg);
    }
    if($registro->tab == 'series') {
      $consulta = \App\Models\Serie::withTrashed()->findOrFail($registro->id_reg);
    }
    if($registro->tab == 'proveedores') {
      $consulta = \App\Models\Proveedor::with('productos')->withTrashed()->findOrFail($registro->id_reg);
      $this->proveedoresRepo->metodo($metodo, $consulta);
    }
    if($registro->tab == 'contactos_proveedores') {
      $consulta = \App\Models\ContactoProveedor::with('proveedor')->withTrashed()->findOrFail($registro->id_reg);
      if($consulta->proveedor == null) {
        $existe_llave_primaria = false;
      }
    }
    if($registro->tab == 'armados') {
      $consulta = \App\Models\Armado::with(['imagenes'=> function ($query) {
                                        $query->withTrashed();
                                      }])->withTrashed()->findOrFail($registro->id_reg);
      $this->armadosRepo->metodo($metodo, $consulta);
    }
    if($registro->tab == 'armado_tiene_imagenes') {
      $consulta = \App\Models\ArmadoImagen::with('armado')->withTrashed()->findOrFail($registro->id_reg);
      if($consulta->armado == null) {
        $existe_llave_primaria = false;
      }
      $this->armadoTieneImagenesRepo->metodo($metodo, $consulta);
    }
    if($registro->tab == 'productos') {
      $consulta = \App\Models\Producto::withTrashed()->findOrFail($registro->id_reg);
      $this->productosRepo->metodo($metodo, $consulta);
    }
    if($registro->tab == 'cotizaciones') {
      $consulta = \App\Models\Cotizacion::withTrashed()->findOrFail($registro->id_reg);
    }
    if($registro->tab == 'costos_de_envio') {
      $consulta = \App\Models\CostoDeEnvio::withTrashed()->findOrFail($registro->id_reg);
    }
    if($registro->tab == 'pedidos') {
      $consulta = \App\Models\Pedido::with(['armados', 'pagos'])->withTrashed()->findOrFail($registro->id_reg);
      $this->$this->pedidosRepo->metodo($metodo, $consulta);
    }
    if($consulta == null) {return abort(403, 'Registro no encontrado.');} // ABORTA LA OPERACIÓN EN CASO DE QUE LA CONSULTA SEA NULL
    return [
      'consulta'              => $consulta,
      'existe_llave_primaria' => $existe_llave_primaria
    ];
  }
}