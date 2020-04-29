<?php
namespace App\Http\Controllers\Perfil\Recordatorio;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RecordatorioController extends Controller {
  public function index() {
    return view('perfil.recordatorio.per_rec_index');  
  }
}