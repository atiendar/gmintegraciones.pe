<?php
namespace App\Repositories\cotizacion;
// Models
use App\Models\Cotizacion;
// Notifications
use App\Notifications\venta\pedidoActivo\NotificacionRegistrarPedido;
// Repositories
use App\Repositories\cotizacion\CotizacionRepositories;
use App\Repositories\sistema\serie\SerieRepositories;
use App\Repositories\usuario\UsuarioRepositories;
use App\Repositories\sistema\sistema\SistemaRepositories;
use App\Repositories\sistema\plantilla\PlantillaRepositories;
use App\Repositories\venta\pedidoActivo\PedidoActivoRepositories;
// Otro
use Illuminate\Support\Facades\Auth;
use DB;

class AprobarCotizacionRepositories implements AprobarCotizacionInterface {
  protected $cotizacionRepo;
  protected $papeleraDeReciclajeRepo;
  protected $serieRepo;
  protected $usuarioRepo;
  protected $sistemaRepo;
  protected $plantillaRepo;
  protected $pedidoActivoRepo;
  public function __construct(CotizacionRepositories $cotizacionRepositories, SerieRepositories $serieRepositories, UsuarioRepositories $usuarioRepositories, SistemaRepositories $sistemaRepositories, PlantillaRepositories $plantillaRepositories, PedidoActivoRepositories $pedidoActivoRepositories) {
    $this->cotizacionRepo   = $cotizacionRepositories;
    $this->serieRepo        = $serieRepositories;
    $this->usuarioRepo      = $usuarioRepositories;
    $this->sistemaRepo      = $sistemaRepositories;
    $this->plantillaRepo    = $plantillaRepositories;
    $this->pedidoActivoRepo = $pedidoActivoRepositories;
  } 
  public function aprobar($id_cotizacion) {
    try { DB::beginTransaction();
      $cotizacion = $this->cotizacionRepo->cotizacionAsignadoFindOrFailById($id_cotizacion, 'armados', config('app.abierta'));
      $armados = $cotizacion->armados()->with('productos', 'direcciones')->get();

      // CREA EL PEDIDO
      $pedido = new \App\Models\Pedido();
      $pedido->serie            = $this->sistemaRepo->datos('ser_pedidos');
      $pedido->num_pedido       = $this->serieRepo->sumaUnoALaUltimaSerie('Pedidos (Serie)', $this->sistemaRepo->datos('ser_pedidos'));
      $pedido->ult_let          = 'A';
      $pedido->user_id          = $cotizacion->user_id;
      $pedido->tot_de_arm       = $cotizacion->tot_arm;
      $pedido->mont_tot_de_ped  = $cotizacion->tot;
      $pedido->estat_vent_arm   = config('app.armados_cargados');
      $pedido->asignado_ped     = Auth::user()->email_registro;
      $pedido->created_at_ped   = Auth::user()->email_registro;
      $pedido->save();

      $contador2    = 0;
      $contador3    = 0;
      $productos    = null;
      $direcciones  = null;
      foreach($armados as $armado) {
        if($armado->cant != $armado->cant_direc_carg) {
          return abort(500, 'No se han registrado todas las direcciones al armado '.$armado->nom);
        }

        // REGISTRA LOS ARMADOS AL PEDIDO
        $armado_pedido               = new \App\Models\PedidoArmado();
        $armado_pedido->cod          = $this->pedidoActivoRepo->sumaUnoALaUltimaLetraYArmadosCargados($pedido, $armado->cant);
        $armado_pedido->cant         = $armado->cant;
        $armado_pedido->tip          = $armado->tip;
        $armado_pedido->nom          = $armado->nom;
        $armado_pedido->sku          = $armado->sku;
        $armado_pedido->gama         = $armado->gama;
        $armado_pedido->prec         = $armado->prec_redond;
        $armado_pedido->pes          = $armado->pes;
        $armado_pedido->alto         = $armado->alto;
        $armado_pedido->ancho        = $armado->ancho;
        $armado_pedido->largo        = $armado->largo;
        $armado_pedido->es_de_regalo = $armado->es_de_regalo;
        if($armado->es_de_regalo == 'Si') {
          $armado_pedido->aut   = config('app.pendiente');
        }
//        $armado_pedido->coment_vent  = $request->comentarios_ventas;
        $armado_pedido->pedido_id    = $pedido->id;
        $armado_pedido->created_at_ped_arm = Auth::user()->email_registro;
        $armado_pedido->save();

        // REGISTRA LOS PRODUCTOS AL ARMADO
        foreach($armado->productos as $producto) {
          $productos_armado[$contador2]['id_producto']      = $producto->id;
          $productos_armado[$contador2]['cant']             = $producto->cant;
          $productos_armado[$contador2]['produc']           = $producto->produc;
          $productos_armado[$contador2]['sku']              = $producto->sku;
          $productos_armado[$contador2]['pedido_armado_id'] = $armado_pedido->id;
          $contador2 +=1;
        }

        // REGISTRA LAS DIRECCIONES AL ARMADO
        foreach($armado->direcciones as $direccion) {
          $direcciones[$contador3]['cant'] = $direccion->cant;
          $direcciones[$contador3]['met_de_entreg_de_vent']     = $direccion->met_de_entreg_de_vent;
          $direcciones[$contador3]['est_a_la_q_se_cotiz']       = $direccion->est_a_la_q_se_cotiz;
          $direcciones[$contador3]['detalles_de_la_ubicacion']  = $direccion->detalles_de_la_ubicacion;
          $direcciones[$contador3]['tip_env']                   = $direccion->tip_env;
          $direcciones[$contador3]['cost_por_env_vent']         = $direccion->cost_por_env_vent;
          $direcciones[$contador3]['created_at_direc_arm']      = Auth::user()->email_registro;
          $direcciones[$contador3]['pedido_armado_id']          = $armado_pedido->id;
          $contador3 +=1;
        }
      }
      if($productos != null) {
        \App\Models\PedidoArmadoTieneProducto::insert($productos);
      }
      if($direcciones != null) {
        \App\Models\PedidoArmadoTieneDireccion::insert($direcciones);
      }

      // REGISTRA EL PAGO TOTAL A PAGAR
      $pago = new \App\Models\Pago();
      $pago->pedido_id    = $pedido->id;
      $pago->save();


      // CORREO ALTA DE PEDIDO
      $cliente    = $this->usuarioRepo->getUsuarioFindOrFail($pedido->user_id);
      $plantilla  = $this->plantillaRepo->plantillaFindOrFailById($this->sistemaRepo->datos('plant_vent_reg_ped'));
      $cliente->notify(new NotificacionRegistrarPedido($cliente, $pedido, $plantilla)); // Envió de correo electrónico

      // CIERRA LA COTIZACIÓN
      $cotizacion->estat = config('app.cerrada');
      $cotizacion->num_pedido_gen = $pedido->num_pedido;
      $cotizacion->save();

      DB::commit();
      return (object) [
        'cotizacion'  => $cotizacion,
        'pedido'      => $pedido
      ];
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
}