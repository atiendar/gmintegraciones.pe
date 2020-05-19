<?php
namespace App\Repositories\pago;
// Models
use App\Models\Pago;
// Events
use App\Events\layouts\ActividadRegistrada;
use App\Events\layouts\ArchivoCargado;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Repositories
use App\Repositories\venta\pedidoActivo\PedidoActivoRepositories;
// Otros
use Illuminate\Support\Facades\Auth;
use DB;

class PagoRepositories implements PagoInterface {
  protected $serviceCrypt;
  protected $pedidoActivoRepo;
  public function __construct(ServiceCrypt $serviceCrypt, PedidoActivoRepositories $pedidoActivoRepositories) {
    $this->serviceCrypt = $serviceCrypt;
    $this->pedidoActivoRepo = $pedidoActivoRepositories;
  }
  public function getPagination($request) {
    return Pago::with('pedido')->buscar($request->opcion_buscador, $request->buscador)->orderBy('id', 'DESC')->paginate($request->paginador);
  }
  public function store($request) {
    try { DB::beginTransaction();
      $pedido = $this->pedidoActivoRepo->getPedidoFindOrFail($this->serviceCrypt->encrypt($request->id_pedido));
      $pago = new Pago();
      $pago->serie          = $pedido->serie;
      $pago->cod_fact       = $pedido->serie;
      $pago->form_de_pag    = $request->forma_de_pago;
      $pago->mont_de_pag    = $request->monto_del_pago;
      $pago->pedido_id      = $request->id_pedido;      
      $pago->created_at_pag = Auth::user()->email_registro;

      if($request->hasfile('comprobante_de_pago')) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        $imagen = ArchivoCargado::dispatch(
          $request->file('comprobante_de_pago'), // Archivo blob
          'public/venta/pedido/' . $pedido->serie . '/', // Ruta en la que guardara el archivo
          'pago-' . time() . '.', // Nombre del archivo
          null // Ruta y nombre del archivo anterior
        ); 
        $pago->comp_de_pag_rut  = $imagen[0]['ruta'];
        $pago->comp_de_pag_nom  = $imagen[0]['nombre'];
      }
      if($request->hasfile('copia_de_identificacion')) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        $imagen = ArchivoCargado::dispatch(
          $request->file('copia_de_identificacion'), // Archivo blob
          'public/venta/pedido/' . $pedido->serie . '/', // Ruta en la que guardara el archivo
          'pago-' . time() . '.', // Nombre del archivo
          null // Ruta y nombre del archivo anterior
        ); 
        $pago->comp_de_pag_rut  = $imagen[0]['ruta'];
        $pago->comp_de_pag_nom  = $imagen[0]['nombre'];
      }
    //  dd(   $pago   );
      $pago->save();
      $pago->cod_fact .= $pago->id;
      $pago->save();
    //  dd(   $pago   );
      $this->pedidoActivoRepo->getEstatusPagoPedido($pedido);
      /*
      *
      * FALTA ENVIAR CORREO CON EL CODIGO DE FACTURA
      *
      */
      DB::commit();
      return $pago;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function getPagoFindOrFailById($id_pago) {
    $id_pago = $this->serviceCrypt->decrypt($id_pago);
    return Pago::with('pedido')->findOrFail($id_pago);
  }
}