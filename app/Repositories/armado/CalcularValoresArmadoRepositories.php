<?php
namespace App\Repositories\armado;
// Repositories
use App\Repositories\servicio\calculo\CalculoRepositories;

class CalcularValoresArmadoRepositories implements CalcularValoresArmadoInterface {
  protected $calculoRepo;
  public function __construct(CalculoRepositories $calculoRepositories) {
    $this->calculoRepo      = $calculoRepositories;
  }
  public function calcularValoresArmado($armado, $productos) {
    $hastaC       = count($productos) - 1;
    $prec_origin  = 0;
    $peso         = 0;
    $alto         = 0;
    $ancho        = 0;
    $largo        = 0;
    for($contador2 = 0; $contador2 <= $hastaC; $contador2++) {
      if($productos[$contador2]->pivot != null) {
        $cant = $productos[$contador2]->pivot->cant;
      }else {
        $cant = $productos[$contador2]->cant;
      }

      // Calcular nuevo precio
      $prec_origin += $productos[$contador2]->prec_clien * $cant;
     
      // Calcular nuevo peso
      $peso += $productos[$contador2]->pes * $cant;
      
      // Calcular nuevas medidas
      $alto += $productos[$contador2]->alto * $cant;
      $ancho += $productos[$contador2]->ancho * $cant;
      $largo += $productos[$contador2]->largo * $cant;
    }
    $armado->prec_origin   = $prec_origin;
    $armado->pes           = $peso;
    $armado->alto          = $alto;
    $armado->ancho         = $ancho;
    $armado->largo         = $largo;
    $armado->prec_redond = $this->calculoRepo->redondearUnidadA9DelPrecio($armado->prec_origin);
    $armado->save();
    return $armado;
  }
}