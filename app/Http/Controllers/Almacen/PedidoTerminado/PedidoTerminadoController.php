<?php

namespace App\Http\Controllers\Almacen\PedidoTerminado;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\almacen\pedidoTerminado\PedidoTerminadoRepositories;
class PedidoTerminadoController extends Controller
{
    public function __construct(PedidoTerminadoRepositories $PedidoTerminadoRepositories) {
     $this->pedidoTerminadoRepo = $PedidoTerminadoRepositories;      }
    public function index(Request $request) {
     $pedidos = $this->pedidoTerminadoRepo->getPagination($request);
     return view('almacen.pedido.pedido_terminado.alm_pedTer_index', compact('pedidos'));
    }
    public function create() {
        //
    }
    public function store(Request $request) {
        //
    }
    public function show($id) {
        //
    }
    public function edit($id) {
        //
    }
    public function update(Request $request, $id) {
        //
    }
    public function destroy($id) {
        //
    }
}
