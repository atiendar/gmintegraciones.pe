<?php
namespace App\Repositories\cotizacion\armadoCotizacion;

class CalcularValoresArmadoCotizacionRepositories implements CalcularValoresArmadoCotizacionInterface {
  public function sumaValoresArmadoCotizacion($armado) {
    $armado = $this->calcularDescuento($armado);
    $sub_total          = ($armado->cant * $armado->prec_redond) + $armado->cost_env;
    $armado->sub_total  = $sub_total - $armado->desc;
    if($armado->con_iva == 'Con IVA') {
      $armado->iva  = $armado->sub_total * 0.16;
    } elseif($armado->con_iva == 'Sin IVA') {
      $armado->iva  = 0;
    }
    $armado->tot    = $armado->sub_total + $armado->iva;
    return $armado;
  }
  public function calcularDescuento($armado) {
    if($armado->es_de_regalo == 'Si') {
      $armado->tip_desc = 'Manual';
      $armado->porc     = null;
      $manual           = $armado->cant * $armado->prec_redond;
      $armado->manu     = $manual;
      $armado->desc     = $manual;
    } elseif($armado->es_de_regalo == 'No') {
      if($armado->getOriginal('es_de_regalo') == $armado->getAttribute('es_de_regalo')) {
        if($armado->tip_desc == 'Manual') {
          $armado->porc = null;
          $armado->desc = $armado->manu;
        } elseif($armado->tip_desc == 'Porcentaje') {
          $armado->manu = null;
          $armado->desc = ($armado->cant * $armado->prec_redond) * $armado->porc;
        }elseif($armado->tip_desc == 'Sin descuento') {
          $armado->porc = null;
          $armado->manu = null;
          $armado->desc = 0.00;
        }
      } elseif($armado->getOriginal('es_de_regalo') != $armado->getAttribute('es_de_regalo')) {
        $armado->tip_desc = null;
        $armado->porc     = null;
        $armado->manu     = 0;
        $armado->desc     = 0;
      }
    }
    return  $armado;
  }
}