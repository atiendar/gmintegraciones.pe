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
    $productos_cotizacion = \App\Models\CotizacionArmadoProductos::where('id_producto', $producto->id)->with('armado')->get();
    foreach($productos_cotizacion as $producto_cotizacion) {
      $producto_cotizacion->alto        = $producto->alto;
      $producto_cotizacion->ancho       = $producto->ancho;
      $producto_cotizacion->largo       = $producto->largo;
      $producto_cotizacion->pes         = $producto->pes;
      $producto_cotizacion->prove       = $producto->prove;
      $producto_cotizacion->prec_prove  = $producto->prec_prove;
      $producto_cotizacion->prec_clien  = $this->calculoRepo->getUtilidadProducto($producto_cotizacion->prec_prove, $producto_cotizacion->utilid, $producto_cotizacion->cost_arm);
      $producto_cotizacion->save();

      $armado = $producto_cotizacion->armado;
      // GENERA LOS NUEVOS VALORES PARA EL ARMADO
      $armado             = $this->calcularValoresArmadoRepo->calcularValoresArmado($armado, $armado->productos);
      $armado             = $this->calcularValoresArmadoCotizacionRepo->sumaValoresArmadoCotizacion($armado);
      $armado->save();

      // GENERA LOS NUEVOS VALORES PARA LA COTIZACIÓN
      $this->calculaValoresCotizacion($armado->cotizacion);
    }
  }
}