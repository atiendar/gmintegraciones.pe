<?php
namespace App\Repositories\cotizacion\armadoCotizacion;
// Models
use App\Models\CotizacionArmado;
use App\Models\CotizacionArmadoProductos;
// Events
use App\Events\layouts\ActividadRegistrada;
// Repositories
use App\Repositories\armado\ArmadoRepositories;
use App\Repositories\almacen\producto\ProductoRepositories;
use App\Repositories\servicio\calculo\CalculoRepositories;
use App\Repositories\cotizacion\CotizacionRepositories;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Otros
use Illuminate\Support\Facades\Auth;
use DB;

class ArmadoCotizacionRepositories implements ArmadoCotizacionInterface {
  protected $serviceCrypt;
  protected $armadoRepo;
  protected $productoRepo;
  protected $calculoRepo;
  protected $cotizacionRepo;
  public function __construct(ServiceCrypt $serviceCrypt, ArmadoRepositories $armadoRepositories, ProductoRepositories $productoRepositories, CalculoRepositories $calculoRepositories,  CotizacionRepositories $cotizacionRepositories) {
    $this->serviceCrypt     = $serviceCrypt;
    $this->armadoRepo        = $armadoRepositories;
    $this->productoRepo     = $productoRepositories;
    $this->calculoRepo      = $calculoRepositories;
    $this->cotizacionRepo   = $cotizacionRepositories;
  }
  public function armadoFindOrFailById($id_armado) {
    $id_armado = $this->serviceCrypt->decrypt($id_armado);
    $armado = CotizacionArmado::with('productos')->findOrFail($id_armado);
    return $armado;
  }





  public function store($request, $id_cotizacion) {
    DB::transaction(function() use($request, $id_cotizacion) {  // Ejecuta una transacción para encapsulan todas las consultas y se ejecuten solo si no surgió algún error
      $cotizacion      = $this->cotizacionRepo->cotizacionAsignadoFindOrFailById($id_cotizacion);
      $armado  = $this->armadoRepo->getArmadoFindOrFail($request->id_armado);
//dd(       $armado             );
      $cotizacion->sub_total  += $armado->prec_redond;
      $cotizacion->iva        += $armado->prec_redond * .16;
      $descuento              = $cotizacion->sub_total - $cotizacion->desc;
      $cotizacion->tot        = $descuento + $cotizacion->iva;
      $cotizacion->save();


      $cot_armado = new CotizacionArmado();
      // FALTA GUARGAR LA IMAGEN
      $cot_armado->id_armado      = $armado->id;
      $cot_armado->tip            = $armado->tip;
      $cot_armado->nom            = $armado->nom;
      $cot_armado->sku            = $armado->sku;
      $cot_armado->gama           = $armado->gama;
      $cot_armado->pes            = $armado->pes;
      $cot_armado->alto           = $armado->alto;
      $cot_armado->ancho          = $armado->ancho;
      $cot_armado->largo          = $armado->largo;
      $cot_armado->prec_redond    = $armado->prec_redond;
      $cot_armado->imp            = $armado->prec_redond;
      $cot_armado->cotizacion_id  = $cotizacion->id;
      $cot_armado->save();






      // Agrega los producto del armado al armado de la cotización
      $camposBD = array('id_producto', 'cant', 'produc', 'sku','prec_prove', 'utilid', 'armado_id', 'created_at', 'updated_at');
      $hastaC = count($armado->productos) - 1;
  //    dd( $hastaC );
      if($hastaC > -1) {
        $productos = $armado->productos;
        $datos = null;
        $contador3 = 0;
        $email_usuario = Auth::user()->email_registro;
        $fecha = date('Y-m-d h:i:s');
        for($contador2 = 0; $contador2 <= $hastaC; $contador2++) {
          $datos[$contador2][$camposBD[$contador3]] = $productos[$contador2]->id;
          $contador3 += 1;
          $datos[$contador2][$camposBD[$contador3]] = $productos[$contador2]->pivot->cant;
          $contador3 += 1;
          $datos[$contador2][$camposBD[$contador3]] = $productos[$contador2]->produc;
          $contador3 += 1;
          $datos[$contador2][$camposBD[$contador3]] = $productos[$contador2]->sku;
          $contador3 += 1;
          $datos[$contador2][$camposBD[$contador3]] = $productos[$contador2]->prec_prove;
          $contador3 += 1;
          $datos[$contador2][$camposBD[$contador3]] = $productos[$contador2]->utilid;
          $contador3 += 1;
          $datos[$contador2][$camposBD[$contador3]] = $cot_armado->id;
          $contador3 += 1;
          $datos[$contador2][$camposBD[$contador3]] = $fecha;
          $contador3 += 1;
          $datos[$contador2][$camposBD[$contador3]] = $fecha;
          $contador3 = 0;
        }
        CotizacionArmadoProductos::insert($datos);
      }
      return $cotizacion;
    });
  }
  public function destroy($id_armado) {
    DB::transaction(function() use($id_armado) {  // Ejecuta una transacción para encapsulan todas las consultas y se ejecuten solo si no surgió algún error
      $producto = $this->productoRepo->getproductoFindOrFailById($id_armado);
      $armado    = $producto->armados->find($this->serviceCrypt->decrypt($id_armado));
      // Calcular nuevo precio
      $armado->prec_origin      -= $producto->prec_clien * $armado->pivot->cant;
      // Calcular nuevo peso
      $armado->pes         -= $producto->pes * $armado->pivot->cant;
      // Calcular nuevas medidas
      $armado->alto          -= $producto->alto * $armado->pivot->cant;
      $armado->ancho         -= $producto->ancho * $armado->pivot->cant;
      $armado->largo         -= $producto->largo * $armado->pivot->cant;
      $armado->prec_redond = $this->calculoRepo->redondearUnidadA9DelPrecio($armado->prec_origin); // Redondeo de precio
      $armado->save();
      $armado->productos()->detach($this->serviceCrypt->decrypt($id_armado));
      return $armado;
    });
  }
  public function getProductosFindOrFail($ids_productos, $hastaC) {
    for($contador2 = 0; $contador2 <= $hastaC; $contador2++) {
      $productos[$contador2] = Producto::select('prec_clien', 'pes', 'alto', 'ancho', 'largo')->where('id', $ids_productos[$contador2])->first();
    }
    return $productos;
  }
}