<?php
namespace App\Http\Controllers\Logistica\DireccionForaneo;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
use App\Http\Requests\logistica\direccionLocal\StoreComprobanteDeSalidaRequest;
use App\Http\Requests\logistica\direccionLocal\StoreComprobanteDeEntregaRequest;
// Repositories
use App\Repositories\logistica\direccionLocal\DireccionLocalRepositories;
use App\Repositories\metodoDeEntrega\MetodoDeEntregaRepositories;
use App\Repositories\venta\pedidoActivo\codigoQR\GenerarQRRepositories;

class DireccionForaneoController extends Controller {
  protected $direccionLocalRepo;
  protected $comprobanteRepo;
  protected $generarQRRepo;
  public function __construct(DireccionLocalRepositories $direccionLocalRepositories, MetodoDeEntregaRepositories $metodoDeEntregaRepositories, GenerarQRRepositories $generarQRRepositories) {
    $this->direccionLocalRepo   = $direccionLocalRepositories;
    $this->metodoDeEntregaRepo  = $metodoDeEntregaRepositories;
    $this->generarQRRepo        = $generarQRRepositories;
  }
  public function index(Request $request) {
    $direcciones_foraneas = $this->direccionLocalRepo->getPagination($request, config('opcionesSelect.select_foraneo_local.Foráneo'), []);
    return view('logistica.pedido.direccion_foraneo.dirFor_index', compact('direcciones_foraneas'));
  }
  public function create($id_direccion) {
    $direccion          = $this->direccionLocalRepo->direccionLocalFindOrFailById($id_direccion, config('opcionesSelect.select_foraneo_local.Foráneo'), [], 'edit');
    $armado             = $direccion->armado;
    $metodos_de_entrega = $this->metodoDeEntregaRepo->getAllMetodosPluck('Local');
    return view('logistica.pedido.direccion_local.comprobante.com_createSalida', compact('direccion', 'armado', 'metodos_de_entrega'));
  }
  public function store(StoreComprobanteDeSalidaRequest $request, $id_direccion) {
    $direccion = $this->direccionLocalRepo->store($request, $id_direccion);
    return $direccion;
  }
}