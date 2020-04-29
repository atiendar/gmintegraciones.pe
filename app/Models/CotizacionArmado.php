<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CotizacionArmado extends Model {
  use SoftDeletes;
  protected $table='cotizacion_tiene_armados';
  protected $primaryKey='id';

  public function productos() {
    return $this->hasMany('App\Models\CotizacionArmadoProductos', 'armado_id')->orderBy('id', 'DESC');
  }
}