<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Notificacion extends Model {
  use SoftDeletes; // Permite habilitar el campo deleted_at en la BD para no eliminar el registro directamente y trabajar sobre una papelera de reciclaje
  protected $table = 'notificaciones';
  protected $primaryKey = 'id';
  protected $guarded = [];
  // Buscador
  public function scopeBuscar($query, $opcion_buscador, $buscador) {
    if($opcion_buscador != null) {
      return $query->where("$opcion_buscador", 'LIKE', "%$buscador%");
    }
  }
  // Relacion 
  public function sender() {
    return $this->belongsTo(\App\User::class, 'sender_id');
  }
}