<?php
namespace App\Http\Controllers\Logistica\DireccionLocal\Comprobante;
use App\Http\Controllers\Controller;
// Request
use App\Http\Requests\logistica\direccionLocal\StoreComprobanteDeSalidaRequest;
use App\Http\Requests\logistica\direccionLocal\UpdateComprobanteDeSalidaRequest;
use App\Http\Requests\logistica\direccionLocal\StoreComprobanteDeEntregaRequest;
// Repositories
use App\Repositories\logistica\direccionLocal\comprobante\ComprobanteRepositories;
use App\Repositories\logistica\direccionLocal\DireccionLocalRepositories;
use App\Repositories\metodoDeEntrega\MetodoDeEntregaRepositories;

class ComprobanteController extends Controller {
  protected $comprobanteRepo;
  protected $direccionLocalRepo;
  protected $metodoDeEntregaRepo;
  public function __construct(ComprobanteRepositories $comprobanteRepositories, DireccionLocalRepositories $direccionLocalRepositories, MetodoDeEntregaRepositories $metodoDeEntregaRepositories) {
    $this->comprobanteRepo      = $comprobanteRepositories;
    $this->direccionLocalRepo   = $direccionLocalRepositories;
    $this->metodoDeEntregaRepo  = $metodoDeEntregaRepositories;
  }
  public function create($id_direccion) {
    $direccion          = $this->direccionLocalRepo->direccionLocalFindOrFailById($id_direccion, config('opcionesSelect.select_foraneo_local.Local'), ['comprobantes']);
    $comprobantes       = $direccion->comprobantes()->paginate(99999999);
    $metodos_de_entrega = $this->metodoDeEntregaRepo->getAllMetodosPluck('Local');
    return view('logistica.pedido.direccion_local.comprobante.com_create', compact('direccion', 'comprobantes', 'metodos_de_entrega'));
  }
  public function store(StoreComprobanteDeSalidaRequest $request, $id_direccion) {
    $comprobante = $this->comprobanteRepo->store($request, $id_direccion);
    return $comprobante;
  }
  public function show($id_comprobante) {
    $comprobante = $this->comprobanteRepo->comprobanteFindOrFailById($id_comprobante, ['direccion']);
    $direccion = $comprobante->direccion;
    return view('logistica.pedido.direccion_local.comprobante.com_show', compact('comprobante', 'direccion'));
  }
  public function edit($id_comprobante) {
    $comprobante = $this->comprobanteRepo->comprobanteFindOrFailById($id_comprobante, ['direccion']);
    $direccion = $comprobante->direccion;
    $metodos_de_entrega = $this->metodoDeEntregaRepo->getAllMetodosPluck('Local');
    return view('logistica.pedido.direccion_local.comprobante.com_edit', compact('comprobante', 'direccion', 'metodos_de_entrega'));
  }
  public function update(UpdateComprobanteDeSalidaRequest $request, $id_comprobante) {
    $comprobante = $this->comprobanteRepo->update($request, $id_comprobante);
    return $comprobante;
  }
  public function createEntrega($id_comprobante) {
    $comprobante  = $this->comprobanteRepo->comprobanteFindOrFailById($id_comprobante, ['direccion']);
    $direccion    = $comprobante->direccion;
    return view('logistica.pedido.direccion_local.comprobante.com_createComprobante', compact('comprobante', 'direccion'));
  }
  public function storeEntrega(StoreComprobanteDeEntregaRequest $request, $id_comprobante) {
    $comprobante = $this->comprobanteRepo->storeEntrega($request, $id_comprobante);
    return $comprobante;
  }
}