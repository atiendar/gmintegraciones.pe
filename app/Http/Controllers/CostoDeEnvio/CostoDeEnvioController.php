<?php
namespace App\Http\Controllers\CostoDeEnvio;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class CostoDeEnvioController extends Controller {
  public function obtener(Request $request) {
    if($request->ajax()) {
      $datos = \App\Models\CostoDeEnvio::metodoDeEntrega($request->metodo_de_entrega)->estado($request->estado)->tipoDeEnvio($request->tipo_de_envio)->sinSeleccion($request->metodo_de_entrega, $request->estado, $request->tipo_de_envio)->get();
      return $datos;
    } else {
      return view('home');
    }
  }
}