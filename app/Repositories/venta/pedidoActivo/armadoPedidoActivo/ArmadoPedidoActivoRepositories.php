<?php
namespace App\Repositories\venta\pedidoActivo\armadoPedidoActivo;
// Models
use App\Models\PedidoArmado;
use App\Models\PedidoArmadoTieneProducto;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Repositories
use App\Repositories\armado\ArmadoRepositories;
use App\Repositories\papeleraDeReciclaje\PapeleraDeReciclajeRepositories;
use App\Repositories\venta\pedidoActivo\PedidoActivoRepositories;
use App\Repositories\cotizacion\CotizacionRepositories;
// Otros
use Illuminate\Support\Facades\Auth;
use DB;

class ArmadoPedidoActivoRepositories implements ArmadoPedidoActivoInterface {
  protected $serviceCrypt;
  protected $armadoRepo;
  protected $papeleraDeReciclajeRepo;
  protected $pedidoActivoRepo;
  protected $cotizacionRepo;
  public function __construct(ServiceCrypt $serviceCrypt, ArmadoRepositories $armadoRepositories, PapeleraDeReciclajeRepositories $papeleraDeReciclajeRepositories, PedidoActivoRepositories $pedidoActivoRepositories, CotizacionRepositories $cotizacionRepositories) {
    $this->serviceCrypt             = $serviceCrypt;
    $this->armadoRepo               = $armadoRepositories;
    $this->papeleraDeReciclajeRepo  = $papeleraDeReciclajeRepositories;
    $this->pedidoActivoRepo         = $pedidoActivoRepositories;
    $this->cotizacionRepo           = $cotizacionRepositories;
  } 
  public function armadoFindOrFailById($id_armado) {
    $id_armado = $this->serviceCrypt->decrypt($id_armado);
    $armado = PedidoArmado::with('productos', 'direcciones', 'pedido')->findOrFail($id_armado);
    return $armado;
  }
  public function store($request, $id_pedido) {
    DB::transaction(function() use($request, $id_pedido) { // Ejecuta una transacción para encapsulan todas las consultas y se ejecuten solo si no surgió algún error
      $pedido = $this->pedidoActivoRepo->getPedidoFindOrFail($id_pedido);
      if($request->registrar_armados_por == 'Cotización') {
        $cotizacion = $this->cotizacionRepo->getCotizacionFindOrFail($this->serviceCrypt->encrypt($request->cotizacion));
        $armados = $cotizacion->armados()->with('productos')->get();
        if($armados->sum('cant') > $pedido->tot_de_arm) {
          toastr()->error('¡Cotización no permitida! (El total de armados registrados supera el total de armados del pedido)'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
          return back();
        }
        $hastaC = count($armados) - 1;
        for($contador2 = 0; $contador2 <= $hastaC; $contador2++) {
          $datos = (object) [
            'cantidad'            => $armados[$contador2]->cant,
            'es_de_regalo'        => 'No',
            'comentarios_ventas'  => $request->comentarios_ventas
          ];
          $this->storeFiles($pedido, $datos, $armados[$contador2]);
        }
      } elseif($request->registrar_armados_por == 'Manual') {
        $armado = $this->armadoRepo->getArmadoFindOrFail($request->armado);
        $this->storeFiles($pedido, $request, $armado);
      }
      $this->pedidoActivoRepo->getEstatusVentas($pedido);
    });
  }
  public function storeFiles($pedido, $request, $armado) {   
    $armado_pedido               = new PedidoArmado();
    $armado_pedido->cod          = $this->pedidoActivoRepo->sumaUnoALaUltimaLetraYArmadosCargados($pedido, $request->cantidad);
    $armado_pedido->cant         = $request->cantidad;
    $armado_pedido->tip          = $armado->tip;
    $armado_pedido->nom          = $armado->nom;
    $armado_pedido->sku          = $armado->sku;
    $armado_pedido->gama         = $armado->gama;
    $armado_pedido->prec         = $armado->prec_redond;
    $armado_pedido->pes          = $armado->pes;
    $armado_pedido->alto         = $armado->alto;
    $armado_pedido->ancho        = $armado->ancho;
    $armado_pedido->largo        = $armado->largo;
    $armado_pedido->regalo       = $request->es_de_regalo;
    if($request->es_de_regalo == 'Si') {
      $armado_pedido->autorizado   = 'Pendiente';
    }
    $armado_pedido->coment_vent  = $request->comentarios_ventas;
    $armado_pedido->pedido_id    = $pedido->id;
    $armado_pedido->created_at_ped_arm = Auth::user()->email_registro;

/*
    if($armado->img_nom != null) {
      $imagen = file(\Storage::url($armado->img_rut.$armado->img_nom));
      dd($imagen);
      $ruta = 'public/venta/pedido/' . $pedido->id . '/armado/';
      $nombre = $armado->img_nom;
      copy(\Storage::url($armado->img_rut.$armado->img_nom), \Storage::url($ruta.$nombre));

      // Dispara el evento registrado en App\Providers\EventServiceProvider.php
      $imagen = ArchivoCargado::dispatch(
        $request->file('imagen'), // Archivo blob
        'public/perfil/' . date("Y-m") . '/', // Ruta en la que guardara el archivo
        'perfil-' . time() . '.', // Nombre del archivo
        null // Ruta y nombre del archivo anterior
      ); 
      $armado_pedido->img_rut = $ruta;
      $armado_pedido->img_nom = $nombre;
    }
*/
    $armado_pedido->save();

    // Agrega los producto del armado al armado del pedido
    $camposBD = array('id_producto', 'cant', 'produc', 'sku', 'pedido_armado_id', 'created_at', 'updated_at');
    $hastaC = count($armado->productos) - 1;
    if($hastaC > -1) {
      $productos = $armado->productos;
      $datos = null;
      $contador3 = 0;
      $fecha = date('Y-m-d h:i:s');
      for($contador2 = 0; $contador2 <= $hastaC; $contador2++) {
        $datos[$contador2][$camposBD[$contador3]] = $productos[$contador2]->id;
        $contador3 += 1;
        if($productos[$contador2]->pivot == null) {
          $cantid = $productos[$contador2]->cant;
        } else {
          $cantid = $productos[$contador2]->pivot->cant;
        }
        $datos[$contador2][$camposBD[$contador3]] = $cantid;
        $contador3 += 1;
        $datos[$contador2][$camposBD[$contador3]] = $productos[$contador2]->produc;
        $contador3 += 1;
        $datos[$contador2][$camposBD[$contador3]] = $productos[$contador2]->sku;
        $contador3 += 1;
        $datos[$contador2][$camposBD[$contador3]] = $armado_pedido->id;
        $contador3 += 1;
        $datos[$contador2][$camposBD[$contador3]] = $fecha;
        $contador3 += 1;
        $datos[$contador2][$camposBD[$contador3]] = $fecha;
        $contador3 = 0;
      }
      PedidoArmadoTieneProducto::insert($datos);
    }
    return $armado_pedido;
  }
}