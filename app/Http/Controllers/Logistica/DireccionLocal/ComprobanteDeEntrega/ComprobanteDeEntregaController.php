<?php
namespace App\Http\Controllers\Logistica\DireccionLocal\ComprobanteDeEntrega;
use App\Http\Controllers\Controller;
// Request
use App\Http\Requests\logistica\direccionLocal\StoreComprobanteDeEntregaRequest;
// Repositories
use App\Repositories\logistica\direccionLocal\comprobanteDeSalida\ComprobanteDeSalidaRepositories;
use App\Repositories\logistica\direccionLocal\DireccionLocalRepositories;

class ComprobanteDeEntregaController extends Controller {
  protected $comprobanteDeSalidaRepo;
  protected $direccionLocalRepo;
  public function __construct(ComprobanteDeSalidaRepositories $comprobanteDeSalidaRepositories, DireccionLocalRepositories $direccionLocalRepositories) {
    $this->comprobanteDeSalidaRepo  = $comprobanteDeSalidaRepositories;
    $this->direccionLocalRepo       = $direccionLocalRepositories;
  }
  public function index($id_direccion) {
    $direccion          = $this->direccionLocalRepo->direccionLocalFindOrFailById($id_direccion, config('opcionesSelect.select_foraneo_local.Local'), ['comprobantes']);
    $comprobantes       = $direccion->comprobantes()->paginate(99999999);
    return view('logistica.pedido.direccion_local.comprobante_de_entrega.comEnt_index', compact('direccion', 'comprobantes'));
  }
  public function create($id_comprobante) {
    $comprobante  = $this->comprobanteDeSalidaRepo->comprobanteFindOrFailById($id_comprobante, ['direccion']);
    $direccion    = $comprobante->direccion;
    return view('logistica.pedido.direccion_local.comprobante_de_entrega.comEnt_create', compact('comprobante', 'direccion'));
  }
  public function store(StoreComprobanteDeEntregaRequest $request, $id_comprobante) {
    return $request->all();
  }
}