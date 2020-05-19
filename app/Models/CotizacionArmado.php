<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CotizacionArmado extends Model {
//  use SoftDeletes;
  protected $table='cotizacion_tiene_armados';
  protected $primaryKey='id';

  public function cotizacion() {
    return $this->belongsTo('App\Models\Cotizacion')->orderBy('id', 'DESC');
  }
  public function productos() {
    return $this->hasMany('App\Models\CotizacionArmadoProductos', 'armado_id')->orderBy('id', 'DESC');
  }
  public function direcciones() {
    return $this->hasMany('App\Models\CotizacionArmadoTieneDirecciones', 'armado_id')->orderBy('id', 'DESC');
  }
}