<?php
namespace App\Http\Controllers\Venta\PedidoActivo\ArmadoPedidoActivo\Direccion;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
// Repositories
use App\Repositories\venta\pedidoActivo\armadoPedidoActivo\direccion\DireccionArmadoRepositories;

class DireccionController extends Controller {
  protected $direccionArmadoRepo;
  public function __construct(DireccionArmadoRepositories $direccionArmadoRepositories) {
    $this->direccionArmadoRepo = $direccionArmadoRepositories;
  }
  public function store(Request $request, $id_armado) {
    $this->direccionArmadoRepo->store($request, $id_armado);
    toastr()->success('¡Dirección registrada exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function show($id_direccion) {
    dd('show');
  }
  public function edit($id_direccion) {
    dd('edit');
  }
  public function update($id_direccion) {
    dd('update');
  }
}