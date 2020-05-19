<?php
namespace App\Repositories\cotizacion\armadoCotizacion;
// Models
use App\Models\CotizacionArmado;
// Repositories
use App\Repositories\armado\ArmadoRepositories;
use App\Repositories\cotizacion\CotizacionRepositories;
use App\Repositories\cotizacion\CalcularValoresCotizacionRepositories;
use App\Repositories\cotizacion\ArmadoCotizacion\ProductoArmado\StoreFilesRepositories;
use App\Repositories\cotizacion\armadoCotizacion\CalcularValoresArmadoCotizacionRepositories;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Otros
use Illuminate\Support\Facades\Auth;
use DB;

class ArmadoCotizacionRepositories implements ArmadoCotizacionInterface {
  protected $serviceCrypt;
  protected $armadoRepo;
  protected $calculoRepo;
  protected $cotizacionRepo;
  protected $calcularValoresCotizacionRepo;
  protected $storeFilesRepo;
  protected $calcularValoresArmadoCotizacionRepo;
  public function __construct(ServiceCrypt $serviceCrypt, ArmadoRepositories $armadoRepositories, CotizacionRepositories $cotizacionRepositories, CalcularValoresCotizacionRepositories $calcularValoresCotizacionRepositories, StoreFilesRepositories $storeFilesRepositories, CalcularValoresArmadoCotizacionRepositories $calcularValoresArmadoCotizacionRepositories) {
    $this->serviceCrypt                         = $serviceCrypt;
    $this->armadoRepo                           = $armadoRepositories;
    $this->cotizacionRepo                       = $cotizacionRepositories;
    $this->calcularValoresCotizacionRepo        = $calcularValoresCotizacionRepositories;
    $this->storeFilesRepo                       = $storeFilesRepositories;
    $this->calcularValoresArmadoCotizacionRepo  = $calcularValoresArmadoCotizacionRepositories;
  }
  public function armadoFindOrFailById($id_armado, $relaciones) { // 'cotizacion', 'productos', 'direcciones'
    $id_armado = $this->serviceCrypt->decrypt($id_armado);
    $armado = CotizacionArmado::with($relaciones)->findOrFail($id_armado);
    return $armado;
  }
  public function store($request, $id_cotizacion) {
    DB::transaction(function() use($request, $id_cotizacion) {  // Ejecuta una transacción para encapsulan todas las consultas y se ejecuten solo si no surgió algún error
      $cotizacion = $this->cotizacionRepo->cotizacionAsignadoFindOrFailById($id_cotizacion, [], config('app.abierta'));
      $armado     = $this->armadoRepo->getArmadoFindOrFail($request->id_armado);
      $this->verificarElEstatusDeLaCotizacion($cotizacion->estat);
      

      // GUARDA EL REGISTRO DEL ARMADO
      $cot_armado = new CotizacionArmado();
      // FALTA GUARGAR LA IMAGEN
      $cot_armado->id_armado      = $armado->id;
      $cot_armado->tip            = $armado->tip;
      $cot_armado->nom            = $armado->nom;
      $cot_armado->sku            = $armado->sku;
      $cot_armado->gama           = $armado->gama;
      $cot_armado->dest           = $armado->dest;
      $cot_armado->pes            = $armado->pes;
      $cot_armado->alto           = $armado->alto;
      $cot_armado->ancho          = $armado->ancho;
      $cot_armado->largo          = $armado->largo;
      $cot_armado->prec_origin    = $armado->prec_origin;
      $cot_armado->prec_redond    = $armado->prec_redond;
      $cot_armado->sub_total      = $armado->prec_redond;

      if( $cotizacion->con_iva == 'on') {
        $cot_armado->iva          = $cot_armado->sub_total * .16;
      } else {
        $cot_armado->iva          = 0;
      }

      $cot_armado->tot            = $cot_armado->sub_total + $cot_armado->iva;
      $cot_armado->cotizacion_id  = $cotizacion->id;
      $cot_armado->created_at_arm = Auth::user()->email_registro;
      $cot_armado->save();

      // Agrega los producto del armado al armado de la cotización
      $this->storeFilesRepo->storeProductos($armado->productos, $cot_armado->id);

       // GENERA LOS NUEVOS PRECIOS DE LA COTIZACIÓN
       $this->calcularValoresCotizacionRepo->calculaValoresCotizacion($cotizacion);
    });
  }
  public function update($request, $id_armado) {
    try { DB::beginTransaction();
      $armado     = $this->armadoFindOrFailById($id_armado, 'cotizacion');
      $this->verificarElEstatusDeLaCotizacion($armado->cotizacion->estat);
      $cotizacion = $armado->cotizacion;

      // ACTUALIZA Y GENERA LOS NUEVOS PRECIOS DEL ARMADO
      $armado->es_de_regalo = $request->es_de_regalo;
      $armado->cant         = $request->cantidad;
      $armado->tip_desc     = $request->tipo_de_descuento;
      $armado->manu         = $request->manual;
      $armado->porc         = $request->porcentaje;
      $armado               = $this->calcularValoresArmadoCotizacionRepo->sumaValoresArmadoCotizacion($armado);
      $armado->save();

      // GENERA LOS NUEVOS PRECIOS DE LA COTIZACIÓN
      $this->calcularValoresCotizacionRepo->calculaValoresCotizacion($cotizacion);

      DB::commit();
      return $armado;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function destroy($id_armado) {
    try { DB::beginTransaction();
      $armado     = $this->armadoFindOrFailById($id_armado, 'cotizacion');
      $this->verificarElEstatusDeLaCotizacion($armado->cotizacion->estat);
      $cotizacion = $armado->cotizacion;
      $armado->delete();

      // GENERA LOS NUEVOS PRECIOS DE LA COTIZACIÓN
      $this->calcularValoresCotizacionRepo->calculaValoresCotizacion($cotizacion);
      
      DB::commit();
      return $armado;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function verificarSiYaFueModificado($armado, $cotizacion) {
    if($armado->ya_mod == '0') {
      $armado->nom .= ' ('.substr($cotizacion->cliente->nom, 0, 15) .')';
      $armado->ya_mod = '1';
    }
    return $armado;
  }
  public function verificarElEstatusDeLaCotizacion($estatus) {
    if($estatus != config('app.abierta')) { 
      return abort(404); 
    }
  }
}