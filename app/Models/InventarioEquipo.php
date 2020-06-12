<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

class InventarioEquipo extends Model {
  use SoftDeletes;
  use SoftCascadeTrait;

  protected $table = 'inventario_equipos';
  protected $primaryKey = 'id';
  protected $guarded = [];

  protected $dates = ['deleted_at'];
 // protected $softCascade = []; // SE INDICAN LOS NOMBRES DE LAS RELACIONES CON LA QUE TENDRA BORRADO EN CASCADA

  public function historiales() {
    return $this->hasMany('App\Models\Historial')->orderBy('id', 'DESC');
  }
}