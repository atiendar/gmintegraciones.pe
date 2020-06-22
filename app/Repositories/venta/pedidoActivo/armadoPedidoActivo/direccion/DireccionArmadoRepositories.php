<?php
namespace App\Repositories\venta\pedidoActivo\armadoPedidoActivo\direccion;
// Models
use App\Models\PedidoArmadoTieneDireccion;
// Repositories
use App\Repositories\rolCliente\direccion\DireccionRepositories;
// Events
use App\Events\layouts\ArchivoCargado;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Otros
use Illuminate\Support\Facades\Auth;
use DB;

class DireccionArmadoRepositories implements DireccionInterface {
  protected $serviceCrypt;
  protected $direccionRepo;
  public function __construct(ServiceCrypt $serviceCrypt, DireccionRepositories $direccionRepositories) {
    $this->serviceCrypt   = $serviceCrypt;
    $this->direccionRepo  = $direccionRepositories;
  } 
  public function direccionFindOrFailById($id_direccion, $relaciones) { // 'productos', 'direcciones', 'pedido'
    $id_direccion = $this->serviceCrypt->decrypt($id_direccion);
    $direccion = PedidoArmadoTieneDireccion::with($relaciones)->findOrFail($id_direccion);
    return $direccion;
  }
  public function store($request, $id_armado) {
    try { DB::beginTransaction();
      $direccion = new PedidoArmadoTieneDireccion();
      $direccion->tip_tarj_felic  = $request->tipo_de_tarjeta_de_felicitacion;
      $direccion->mens_dedic      = $request->mensaje_de_dedicatoria;

      if($request->hasfile('tarjeta_diseñada_por_el_cliente')) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        $imagen = ArchivoCargado::dispatch(
          $request->file('tarjeta_diseñada_por_el_cliente'), // Archivo blob
          'public/venta/pedidos/'.date("Y").'/tarjetas_diseñadas_por_el_cliente/', // Ruta en la que guardara el archivo
          'tarjeta_diseñadas_por_el_cliente-'.time().'.', // Nombre del archivo
          null // Ruta y nombre del archivo anterior
        ); 
        $direccion->tarj_dise_rut  = $imagen[0]['ruta'];
        $direccion->tarj_dise_nom      = $imagen[0]['nombre'];
      }
      $direccion = $this->direccionRepo->storeFields($direccion, $request);
      $direccion->save();

      dd(  $direccion       );

      DB::commit();
      return $direccion;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
}