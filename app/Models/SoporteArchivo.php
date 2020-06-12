<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class SoporteArchivo extends Model{
  protected $table = 'soporte_archivos';
  protected $primaryKey = 'id';
  protected $guarded = [];
  
  public function soporte(){
    return $this->belongsTo('App\Models\Soporte', 'soporte_id')->orderBy('id', 'DESC');
  }
}