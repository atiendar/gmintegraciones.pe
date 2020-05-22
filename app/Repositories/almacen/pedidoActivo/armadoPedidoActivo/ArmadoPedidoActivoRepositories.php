<?php
namespace App\Repositories\almacen\pedidoActivo\armadoPedidoActivo;
// Models
use App\Models\PedidoArmado;
// Events
use App\Events\layouts\ActividadRegistrada;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Otros
use Illuminate\Support\Facades\Auth;
use DB;

class ArmadoPedidoActivoRepositories implements ArmadoPedidoActivoInterface {
  protected $serviceCrypt;
  public function __construct(ServiceCrypt $serviceCrypt) {
    $this->serviceCrypt = $serviceCrypt;
  }
  public function armadoPedidoActivoFindOrFailById($id_armado) {
    $id_armado = $this->serviceCrypt->decrypt($id_armado); 
    return PedidoArmado::with('pedido')->where(function ($query){
      $query->where('estat', config('app.en_espera_de_compra'))
        ->orWhere('estat', config('app.en_revision_de_productos'))
        ->orWhere('estat', config('app.cancelado'));
    })->findOrFail($id_armado);
  }
  public function update($request, $id_armado) {
    DB::transaction(function() use($request, $id_armado) {  // Ejecuta una transacción para encapsulan todas las consultas y se ejecuten solo si no surgió algún error
      $armado = $this->armadoPedidoActivoFindOrFailById($id_armado);
      $armado->estat         = $request->estatus;
      $armado->coment_alm    = $request->comentario_almacen;
      if($armado->isDirty()) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        ActividadRegistrada::dispatch(
          'Armado pedido', // Módulo
          'almacen.pedidoActivo.armadoPedidoActivo.show', // Nombre de la ruta
          $id_armado, // Id del registro debe ir encriptado
          $this->serviceCrypt->decrypt($id_armado), // Id del registro a mostrar, este valor no debe sobrepasar los 100 caracteres
          array('Estatus', 'Comentario almacen'), // Nombre de los inputs del formulario
          $armado, // Request
          array('estat', 'coment_alm') // Nombre de los campos en la BD
        ); 
        $armado->updated_at_ped_arm = Auth::user()->email_registro;
      }
      $armado->save();
      return $armado;
    });
  }
  public function armadosTerminadosAlmacen($id_pedido) {
    return PedidoArmado::where(function ($query){
      $query->where('estat',config('app.productos_completos'))
        ->orWhere('estat', config('app.en_produccion'))
        ->orWhere('estat', config('app.en_almacen_de_salida'))
        ->orWhere('estat', config('app.en_ruta'))
        ->orWhere('estat', config('app.entregado'))
        ->orWhere('estat', config('app.sin_entrega_por_falta_de_informacion'))
        ->orWhere('estat', config('app.intento_de_entrega_fallido'));
    })->where('pedido_id', $id_pedido)->sum('cant');
  }
}