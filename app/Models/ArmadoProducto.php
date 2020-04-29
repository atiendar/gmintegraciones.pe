<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArmadoProducto extends Model{
  use SoftDeletes;
  protected $table='armado_tiene_productos';
  protected $primaryKey='id';
  
  public function armado(){
    return $this->belongsTo('App\Models\Armado')->orderBy('id', 'DESC');
  }
}