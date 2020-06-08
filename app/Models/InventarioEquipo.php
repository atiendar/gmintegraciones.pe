<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InventarioEquipo extends Model {
  use SoftDeletes;
  protected $table = 'inventario_equipos';
  protected $primaryKey = 'id';

  public function historiales() {
    return $this->hasMany('App\Models\Historial')->orderBy('id', 'DESC');
  }
}