<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class HistoialArchivo extends Model {
  protected $table = 'historiales_archivos';
  protected $primaryKey = 'id';
  
  public function historial(){
    return $this->belongsTo('App\Models\Historial', 'historial_id')->orderBy('id', 'DESC');
  }
}
