<?php
namespace App\Http\Controllers\Pago\fPedido;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
use App\Http\Requests\pago\fPedido\UpdatePagoRequest;
// Events
use App\Events\layouts\ActividadRegistrada;
use App\Events\layouts\ArchivoCargado;
use App\Events\layouts\ArchivosEliminados;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Repositories
use App\Repositories\venta\pedidoActivo\PedidoActivoRepositories;
use App\Repositories\pago\PagoRepositories;
// Otro
use Illuminate\Support\Facades\Auth;
use DB;

class PagoPedidoController extends Controller {
  protected $serviceCrypt;
  protected $pedidoActivoRepo;
  protected $pagoRepo;
  public function __construct(ServiceCrypt $serviceCrypt, PedidoActivoRepositories $pedidoActivoRepositories, PagoRepositories $pagoRepositories) {
    $this->serviceCrypt     = $serviceCrypt;
    $this->pedidoActivoRepo = $pedidoActivoRepositories;
    $this->pagoRepo         = $pagoRepositories;
  }
  public function index(Request $request) {
    $pedidos =  $this->pedidoActivoRepo->getPagination($request, []);
    return view('pago.fPedido.fpe_index', compact('pedidos'));
  }
  public function create($id_pedido) {
    $pedido         = $this->pedidoActivoRepo->pedidoAsignadoFindOrFailById($id_pedido, ['pagos']);
    $pagos          = $this->pedidoActivoRepo->getPagosPedidoPagination($pedido, (object) ['paginador' => 99999999, 'opcion_buscador' => null]);
    $mont_pag_aprov =  $this->pedidoActivoRepo->getMontoDePagosAprobados($pedido);
    return view('pago.fPedido.fpe_create', compact('pedido', 'pagos', 'mont_pag_aprov'));
  }
  public function show($id_pago) {
    $pago   = $this->pagoRepo->getPagoFindOrFailById($id_pago, ['pedido'], null);
    $pedido = $pago->pedido()->firstOrFail();
    return view('pago.fPedido.pago.pag_show', compact('pago', 'pedido'));
  }
  public function edit($id_pago) {
    $pago = $this->pagoRepo->getPagoFindOrFailById($id_pago, ['pedido'], config('app.rechazado'));
    $pedido = $pago->pedido()->firstOrFail();
    return view('pago.fPedido.pago.pag_edit', compact('pago', 'pedido'));
  }
  public function update(UpdatePagoRequest $request, $id_pago) {
    try { DB::beginTransaction();
      $pago = $this->pagoRepo->getPagoFindOrFailById($id_pago, ['pedido'], null);
      $pago->estat_pag    = $request->estatus_pago;
      $pago->form_de_pag  = $request->forma_de_pago;
      $pago->mont_de_pag  = $request->monto_del_pago;
      
      if($pago->isDirty()) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        ActividadRegistrada::dispatch(
          'Pagos (F. por pedido)', // Módulo
          'pago.fPedido.show', // Nombre de la ruta
          $id_pago, // Id del registro debe ir encriptado
          $pago->cod_fact, // Id del registro a mostrar, este valor no debe sobrepasar los 100 caracteres
          array('Estatus pago', 'Forma de pago', 'Monto del pago'), // Nombre de los inputs del formulario
          $pago, // Request
          array('estat_pag', 'form_de_pag', 'mont_de_pag') // Nombre de los campos en la BD
        ); 
        $pago->updated_at_pag  = Auth::user()->email_registro;
      }
      // ELIMINA LA COPIA DE IDENTIFICACION EN CASO DE QUE LA FORMA DE PAGO SE MODIFIQUE
      if($pago->isDirty('form_de_pag')) {
        ArchivosEliminados::dispatch(
          $ruta_nombre = array($pago->cop_de_indent_rut.$pago->cop_de_indent_nom), 
        );
        $pago->cop_de_indent_rut  = null;
        $pago->cop_de_indent_nom  = null;
      }
      if($request->hasfile('comprobante_de_pago')) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        $imagen = ArchivoCargado::dispatch(
          $request->file('comprobante_de_pago'), // Archivo blob
          'public/pedidos/'.date("Y").'/'.$pago->pedido->num_pedido. '/', // Ruta en la que guardara el archivo
          'comprobante_de_pago-'.time().'.', // Nombre del archivo
          $pago->comp_de_pag_rut.$pago->comp_de_pag_nom // Ruta y nombre del archivo anterior
        ); 
        $pago->comp_de_pag_rut  = $imagen[0]['ruta'];
        $pago->comp_de_pag_nom  = $imagen[0]['nombre'];
      }
      if($request->hasfile('copia_de_identificacion')) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        $imagen = ArchivoCargado::dispatch(
          $request->file('copia_de_identificacion'), // Archivo blob
          'public/pedidos/'.date("Y").'/'.$pago->pedido->num_pedido. '/', // Ruta en la que guardara el archivo
          'copia_de_identificacion-'.time().'.', // Nombre del archivo
          $pago->cop_de_indent_rut.$pago->cop_de_indent_nom // Ruta y nombre del archivo anterior
        ); 
        $pago->cop_de_indent_rut  = $imagen[0]['ruta'];
        $pago->cop_de_indent_nom  = $imagen[0]['nombre'];
      }
      $pago->save();
      $this->pedidoActivoRepo->getEstatusPagoPedido($pago->pedido);

      DB::commit();
      toastr()->success('¡Pago actualizado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
      return redirect(route('pago.fPedido.create', $this->serviceCrypt->encrypt($pago->pedido->id)));
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
}