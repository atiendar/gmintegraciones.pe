<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Historial extends Model {
  use SoftDeletes;
  protected $table = 'historiales';
  protected $primaryKey = 'id';

  public function equipo() {
    return $this->belongsTo('App\Models\InventarioEquipo', 'inventario_equipo_id')->orderBy('id', 'DESC');
  }            
  public function historialarchivos() {
    return $this->hasMany('App\Models\HistoialArchivo')->orderBy('id', 'DESC');
  }
}
