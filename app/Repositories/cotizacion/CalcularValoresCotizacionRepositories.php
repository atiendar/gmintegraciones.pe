<?php
namespace App\Repositories\cotizacion;
// Repositories
use App\Repositories\servicio\calculo\CalculoRepositories;
use App\Repositories\armado\CalcularValoresArmadoRepositories;
use App\Repositories\cotizacion\armadoCotizacion\CalcularValoresArmadoCotizacionRepositories;

class CalcularValoresCotizacionRepositories implements CalcularValoresCotizacionInterface {
  protected $calcularValoresArmadoRepo;
  protected $calculoRepo;
  protected $calcularValoresArmadoCotizacionRepo;
  public function __construct(CalcularValoresArmadoRepositories $calcularValoresArmadoRepositories, CalculoRepositories $calculoRepositories, CalcularValoresArmadoCotizacionRepositories $calcularValoresArmadoCotizacionRepositories) {
    $this->calcularValoresArmadoRepo            = $calcularValoresArmadoRepositories;
    $this->calculoRepo                          = $calculoRepositories;
    $this->calcularValoresArmadoCotizacionRepo  = $calcularValoresArmadoCotizacionRepositories;
  }
  public function calculaValoresCotizacion($cotizacion) {
    $cotizacion->tot_arm    = $cotizacion->armados()->sum('cant');
    $cotizacion->cost_env   = $cotizacion->armados()->sum('cost_env');
    $cotizacion->desc       = $cotizacion->armados()->sum('desc');
    $cotizacion->sub_total  = $cotizacion->armados()->sum('sub_total');
    $cotizacion->iva        = $cotizacion->armados()->sum('iva');
    $cotizacion->tot        = $cotizacion->armados()->sum('tot');
    $cotizacion->save();
  }
  public function calculaValoresCotizacionAlModificarProducto($producto) {
    $productos_armado_cotizacion = \App\Models\CotizacionArmadoProductos::where('id_producto', $producto->id)->with('armado')->withTrashed()->get();
  //  dd(   $productos_armado_cotizacion );
    foreach($productos_armado_cotizacion as $producto_armado_cotizacion) {
      $producto_armado_cotizacion->alto        = $producto->alto;
      $producto_armado_cotizacion->ancho       = $producto->ancho;
      $producto_armado_cotizacion->largo       = $producto->largo;
      $producto_armado_cotizacion->cost_arm    = $producto->cost_arm;
      $producto_armado_cotizacion->pes         = $producto->pes;
      $producto_armado_cotizacion->prove       = $producto->prove;
      $producto_armado_cotizacion->prec_prove  = $producto->prec_prove;
      $producto_armado_cotizacion->prec_clien  = $this->calculoRepo->getUtilidadProducto($producto_armado_cotizacion->prec_prove, $producto_armado_cotizacion->utilid, $producto_armado_cotizacion->cost_arm);
      $producto_armado_cotizacion->save();

      $armado = $producto_armado_cotizacion->armado;

    //  dd($armado);
      // GENERA LOS NUEVOS VALORES PARA EL ARMADO
      $armado             = $this->calcularValoresArmadoRepo->calcularValoresArmado($armado, $armado->productos);
      $armado             = $this->calcularValoresArmadoCotizacionRepo->sumaValoresArmadoCotizacion($armado);
      $armado->save();

      // GENERA LOS NUEVOS VALORES PARA LA COTIZACIÓN
      $this->calculaValoresCotizacion($armado->cotizacion);
    }
  }
}