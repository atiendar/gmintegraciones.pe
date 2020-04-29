<?php
namespace App\Repositories\armado\productoArmado;
// Events
use App\Events\layouts\ActividadRegistrada;
// Repositories
use App\Repositories\armado\ArmadoRepositories;
use App\Repositories\almacen\producto\ProductoRepositories;
use App\Repositories\servicio\calculo\CalculoRepositories;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Otros
use Illuminate\Support\Facades\Auth;
use DB;

class ProductoArmadoRepositories implements ProductoArmadoInterface {
  protected $serviceCrypt;
  protected $armadoRepo;
  protected $productoRepo;
  protected $calculoRepo;
  public function __construct(ServiceCrypt $serviceCrypt, ArmadoRepositories $armadoRepositories, ProductoRepositories $productoRepositories, CalculoRepositories $calculoRepositories) {
    $this->serviceCrypt     = $serviceCrypt;
    $this->armadoRepo        = $armadoRepositories;
    $this->productoRepo     = $productoRepositories;
    $this->calculoRepo      = $calculoRepositories;
  }
  public function store($request, $id_armado) {
    DB::transaction(function() use($request, $id_armado) {  // Ejecuta una transacción para encapsulan todas las consultas y se ejecuten solo si no surgió algún error
      $armado     = $this->armadoRepo->getArmadoFindOrFail($this->serviceCrypt->decrypt($id_armado));
      $hastaC     = count($request->ids_productos) - 1;
      $productos  = $this->productoRepo->getProductosFindOrFail($request->ids_productos, $hastaC);
      for($contador2 = 0; $contador2 <= $hastaC; $contador2++) {
        $armado->prec_origin   += $productos[$contador2]->prec_clien;
        $armado->pes           += $productos[$contador2]->pes;
        $armado->alto          += $productos[$contador2]->alto;
        $armado->ancho         += $productos[$contador2]->ancho;
        $armado->largo         += $productos[$contador2]->largo;
      }
      $armado->prec_redond = $this->calculoRepo->redondearUnidadA9DelPrecio($armado->prec_origin);
      $armado->save();
      $armado->productos()->attach($request->ids_productos);
      return $armado;
    });
  }
  public function destroy($id_armado, $id_producto) {
    DB::transaction(function() use($id_armado, $id_producto) {  // Ejecuta una transacción para encapsulan todas las consultas y se ejecuten solo si no surgió algún error
      $producto = $this->productoRepo->getproductoFindOrFailById($id_producto);
      $armado    = $producto->armados->find($this->serviceCrypt->decrypt($id_armado));
      // Calcular nuevo precio
      $armado->prec_origin  -= $producto->prec_clien * $armado->pivot->cant;
      // Calcular nuevo peso
      $armado->pes          -= $producto->pes * $armado->pivot->cant;
      // Calcular nuevas medidas
      $armado->alto         -= $producto->alto * $armado->pivot->cant;
      $armado->ancho        -= $producto->ancho * $armado->pivot->cant;
      $armado->largo        -= $producto->largo * $armado->pivot->cant;
      $armado->prec_redond  = $this->calculoRepo->redondearUnidadA9DelPrecio($armado->prec_origin); // Redondeo de precio
      $armado->save();
      $armado->productos()->detach($this->serviceCrypt->decrypt($id_producto));
      return $armado;
    });
  }
  public function editCantidad($request, $id_producto, $id_armado) {
    DB::transaction(function() use($request, $id_producto, $id_armado) {  // Ejecuta una transacción para encapsulan todas las consultas y se ejecuten solo si no surgió algún error
      $producto             = $this->productoRepo->getproductoFindOrFailById($id_producto);
      $armado               = $producto->armados->find($this->serviceCrypt->decrypt($id_armado));
      // Calcular nuevo precio
      $armado->prec_origin  -= $producto->prec_clien * $armado->pivot->cant;
      $armado->prec_origin  += $producto->prec_clien * $request->cantidad;
      // Calcular nuevo peso
      $armado->pes          -= $producto->pes * $armado->pivot->cant;
      $armado->pes          += $producto->pes * $request->cantidad;
      // Calcular nuevas medidas
      $armado->alto          -= $producto->alto * $armado->pivot->cant;
      $armado->ancho         -= $producto->ancho * $armado->pivot->cant;
      $armado->largo         -= $producto->largo * $armado->pivot->cant;
      $armado->alto          += $producto->alto * $request->cantidad;
      $armado->ancho         += $producto->ancho * $request->cantidad;
      $armado->largo         += $producto->largo * $request->cantidad;
      $armado->pivot->cant = $request->cantidad;
      $armado->prec_redond = $this->calculoRepo->redondearUnidadA9DelPrecio($armado->prec_origin);
      if($armado->isDirty()) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        ActividadRegistrada::dispatch(
          'Armados', // Módulo
          'armado.show', // Nombre de la ruta
          $this->serviceCrypt->encrypt($armado->id), // Id del registro debe ir encriptado
          $armado->id, // Id del registro a mostrar, este valor no debe sobrepasar los 100 caracteres
          array('Precio original', 'Precio redondeado', 'Peso'), // Nombre de los inputs del formulario
          $armado, // Request
          array('Precio original', 'prec_redond', 'pes') // Nombre de los campos en la BD
        ); 
        $armado->updated_at_arm = Auth::user()->email_registro;
      }
      $armado->save();
      $armado->pivot->save();
    });
  }
}