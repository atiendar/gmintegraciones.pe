<?php
namespace App\Http\Controllers\Almacen\PedidoActivo\ArmadoPedidoActivo\SustitutoArmado;
use App\Http\Controllers\Controller;
// Request
use App\Http\Requests\almacen\pedidoActivo\armadoPedidoActivo\sustitutoArmado\UpdateSustitutoArmadoRequest;
// Models
use App\Models\PedidoArmadoTieneProducto;
use App\Models\PedidoArmadoProductoTieneSustituto;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Repositories
use App\Repositories\almacen\producto\ProductoRepositories;
// Otros
use Illuminate\Support\Facades\Auth;
use DB;

class SustitutoArmadoController extends Controller {
  protected $serviceCrypt;
  protected $productoRepo;
  public function __construct(ServiceCrypt $serviceCrypt, ProductoRepositories $productoRepositories) {
    $this->serviceCrypt   = $serviceCrypt;
    $this->productoRepo   = $productoRepositories;
  }
  public function create($id_producto) {
    $id_producto      = $this->serviceCrypt->decrypt($id_producto);
    $producto         = PedidoArmadoTieneProducto::with('sustitutos')->findOrFail($id_producto);
    $sustitutos       = $producto->sustitutos()->paginate(99999999);
    $produc_original  = $this->productoRepo->getproductoFindById($this->serviceCrypt->encrypt($producto->id_producto), ['sustitutos']);
    
    if($produc_original != NULL) {
      $sustitutos_list = $produc_original->sustitutos()->orderBy('produc', 'DESC')->pluck('produc', 'productos.id');
      $prod_menos = $producto->sustitutos;
      $sustitutos_list = $produc_original->sustitutos()->where(function($query) use($prod_menos) {
        $hastaC = count($prod_menos) -1;
        for($contador2 = 0; $contador2 <= $hastaC; $contador2++) {
          $query->where('productos.id', '!=', $prod_menos[$contador2]->id_producto);
        }
      })->orderBy('produc', 'ASC')->pluck('produc', 'productos.id');
    } else {
      $sustitutos_list = [];
    }

    return view('almacen.pedido.pedido_activo.armado_activo.productos_armado.sustitutos_producto.susPro_create', compact('producto', 'sustitutos', 'sustitutos_list'));
  }
  public function store(UpdateSustitutoArmadoRequest $request, $id_producto) {
    try { DB::beginTransaction();
      $id_producto            = $this->serviceCrypt->decrypt($id_producto);
      $producto_armado_pedido = PedidoArmadoTieneProducto::findOrFail($id_producto);

      // SUMA AL STOCK LA CANTIDAD ESCRITA EN EL FORMULARIO AL PRODUCTO QUE ESTA ASIGNADO DIRECTAMENTE AL ARMADO
      $producto_original1         = $this->productoRepo->getproductoFindOrFailById($this->serviceCrypt->encrypt($producto_armado_pedido->id_producto), []);
      $producto_original1->stock += $request->cantidad;
      $producto_original1->save();

      // RESTA AL STOCK LA CANTIDAD ESCRITA EN EL FORMULARIO AL NUEVO PRODUCTO QUE SE ESTA TOMANDO COMO SUSTITUTO DEL PRODUCTO QUE ESTA ASIGNADO DIRECTAMENTE AL ARMADO
      $producto_original2         = $this->productoRepo->getproductoFindOrFailById($this->serviceCrypt->encrypt($request->sustituto), []);
      $producto_original2->stock -= $request->cantidad;
      $producto_original2->save();
      
      // AGREGA Y ASIGNA EL SUSTITUTO AL PRODUCTO DEL ARMADO
      $sustituto = new PedidoArmadoProductoTieneSustituto();
      $sustituto->id_producto     = $producto_original2->id;
      $sustituto->cant            = $request->cantidad;
      $sustituto->produc          = $producto_original2->produc;
      $sustituto->producto_id     = $id_producto;
      $sustituto->created_at_sus  = Auth::user()->email_registro;
      $sustituto->save();

      DB::commit();
      toastr()->success('¡Sustituto agregado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
      return back();
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function destroy($id_sustituto) {
    try { DB::beginTransaction();
      $id_sustituto            = $this->serviceCrypt->decrypt($id_sustituto);
      $sustituto = PedidoArmadoProductoTieneSustituto::with('producto')->findOrFail($id_sustituto);
      $sustituto->delete();

      // RESTA AL STOCK LA CANTIDAD ESCRITA EN EL FORMULARIO AL PRODUCTO QUE ESTA ASIGNADO DIRECTAMENTE AL ARMADO
      $producto_original1         = $this->productoRepo->getproductoFindById($this->serviceCrypt->encrypt($sustituto->producto->id_producto), []);
      if($producto_original1 != NULL) {
        $producto_original1->stock -= $sustituto->cant;
        $producto_original1->save();
      }
      // SUMA AL STOCK LA CANTIDAD ESCRITA EN EL FORMULARIO AL NUEVO PRODUCTO QUE SE ESTA TOMANDO COMO SUSTITUTO DEL PRODUCTO QUE ESTA ASIGNADO DIRECTAMENTE AL ARMADO
      $producto_original2         = $this->productoRepo->getproductoFindById($this->serviceCrypt->encrypt($sustituto->id_producto), []);
      if($producto_original2 != NULL) {
        $producto_original2->stock += $sustituto->cant;
        $producto_original2->save();
      }

      DB::commit();
      toastr()->success('¡Sustituto eliminado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
      return back();
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
}