<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class QuejaYSugerenciaArchivo extends Model {
  protected $table = 'quejas_y_sugerencias_archivos';
  protected $primaryKey = 'id';

  public function quejaYSugerencia(){
    return $this->belongsTo('App\QuejaYSugerencia')->orderBy('id','DESC');
  }
}