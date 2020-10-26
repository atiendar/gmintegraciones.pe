<?php
namespace App\Repositories\stock;
// Models
use App\Models\Stock;
// Events
use App\Events\layouts\ActividadRegistrada;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Otros
use Illuminate\Support\Facades\Auth;
use DB;

class StockRepositories implements StockInterface {
  protected $serviceCrypt;
  public function __construct(ServiceCrypt $serviceCrypt) {
    $this->serviceCrypt = $serviceCrypt;
  }
  public function stockFindOrFailById($id_stock, $relaciones) {
    $id_stock = $this->serviceCrypt->decrypt($id_stock);
    return Stock::with($relaciones)->findOrFail($id_stock);
  }
  public function getPagination($request) {
    return Stock::with('armados')->buscar($request->opcion_buscador, $request->buscador)->orderBy('id', 'DESC')->paginate($request->paginador);
  }
  public function store($request) {
    DB::transaction(function() use($request) { // Ejecuta una transacción para encapsulan todas las consultas y se ejecuten solo si no surgió algún error
      $stock = new Stock();
      $stock->input 			   = $request->input;
      $stock->value          = $request->value;
      $stock->vista          = $request->value;
      $stock->asignado_ser   = Auth::user()->email_registro;
      $stock->created_at_ser = Auth::user()->email_registro;
      $stock->save();
      return $stock;
    });
  }
  public function update($request, $id_stock) {
    DB::transaction(function() use($request, $id_stock) {  // Ejecuta una transacción para encapsulan todas las consultas y se ejecuten solo si no surgió algún error
      $stock         = $this->stockFindOrFailById($id_stock, []);
      $stock->input  = $request->input;
      $stock->value  = $request->value;
      if($stock->isDirty()) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        ActividadRegistrada::dispatch(
          'Stock', // Módulo
          'stock.show', // Nombre de la ruta
          $id_stock, // Id del registro debe ir encriptado
          $this->serviceCrypt->decrypt($id_stock), // Id del registro a mostrar, este valor no debe sobrepasar los 100 caracteres
          array(''), // Nombre de los inputs del formulario
          $stock, // Request
          array('') // Nombre de los campos en la BD
        ); 
        $stock->updated_at_ser  = Auth::user()->email_registro;
      }
      $stock->vista  = $request->value;
      $stock->save();
      return $stock;
    });
  }
  public function destroy($id_stock) {
    try { DB::beginTransaction();
      $stock = $this->stockFindOrFailById($id_stock, []);
      $stock->forceDelete();
     
      DB::commit();
      return $stock;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function stocksRegistrados() {
    return Stock::with('armados')->get();
  }
}