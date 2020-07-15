<?php
namespace App\Http\Controllers\Logistica\DireccionLocal\ComprobanteDeSalida;
use App\Http\Controllers\Controller;
// Request
use App\Http\Requests\logistica\direccionLocal\StoreComprobanteDeSalidaRequest;
use App\Http\Requests\logistica\direccionLocal\UpdateComprobanteDeSalidaRequest;
// Repositories
use App\Repositories\logistica\direccionLocal\comprobanteDeSalida\ComprobanteDeSalidaRepositories;
use App\Repositories\logistica\direccionLocal\DireccionLocalRepositories;
use App\Repositories\metodoDeEntrega\MetodoDeEntregaRepositories;

class ComprobanteDeSalidaController extends Controller {
  protected $comprobanteDeSalidaRepo;
  protected $direccionLocalRepo;
  protected $metodoDeEntregaRepo;
  public function __construct(ComprobanteDeSalidaRepositories $comprobanteDeSalidaRepositories, DireccionLocalRepositories $direccionLocalRepositories, MetodoDeEntregaRepositories $metodoDeEntregaRepositories) {
    $this->comprobanteDeSalidaRepo  = $comprobanteDeSalidaRepositories;
    $this->direccionLocalRepo       = $direccionLocalRepositories;
    $this->metodoDeEntregaRepo      = $metodoDeEntregaRepositories;
  }
  public function create($id_direccion) {
    $direccion          = $this->direccionLocalRepo->direccionLocalFindOrFailById($id_direccion, ['comprobantes']);
    $comprobantes       = $direccion->comprobantes()->paginate(99999999);
    $metodos_de_entrega = $this->metodoDeEntregaRepo->getAllMetodosPluck();
    return view('logistica.pedido.direccion_local.comprobante_de_salida.com_createComprobanteDeSalida', compact('direccion', 'comprobantes', 'metodos_de_entrega'));
  }
  public function store(StoreComprobanteDeSalidaRequest $request, $id_direccion) {
    $comprobante = $this->comprobanteDeSalidaRepo->store($request, $id_direccion);
    return $comprobante;
  }
  public function show($id_comprobante) {
    $comprobante = $this->comprobanteDeSalidaRepo->comprobanteFindOrFailById($id_comprobante, ['direccion']);
    $direccion = $comprobante->direccion;
    return view('logistica.pedido.direccion_local.comprobante_de_salida.com_show', compact('comprobante', 'direccion'));
  }
  public function edit($id_comprobante) {
    $comprobante = $this->comprobanteDeSalidaRepo->comprobanteFindOrFailById($id_comprobante, ['direccion']);
    $direccion = $comprobante->direccion;
    $metodos_de_entrega = $this->metodoDeEntregaRepo->getAllMetodosPluck();
    return view('logistica.pedido.direccion_local.comprobante_de_salida.com_edit', compact('comprobante', 'direccion', 'metodos_de_entrega'));

  }
  public function update(UpdateComprobanteDeSalidaRequest $request, $id_comprobante) {
    return $request->all();
  }
}