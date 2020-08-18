<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SoporteArchivo extends Model{
  use SoftDeletes;
  protected $table = 'soporte_archivos';
  protected $primaryKey = 'id';

  public function soporte(){
    return $this->belongsTo('App\Models\Soporte', 'soporte_id')->orderBy('id', 'DESC');
  }
}