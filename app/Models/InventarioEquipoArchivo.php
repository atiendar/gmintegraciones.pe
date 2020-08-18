<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InventarioEquipoArchivo extends Model {
    use SoftDeletes;
    protected $table = 'inventario_equipos_archivos';
    protected $primaryKey = 'id';

    public function inventario() {
        return $this->belongsTo('App\Models\InventarioEquipo', 'inventario_equipo_id')->orderBy('id', 'DESC');
    }
    public function scopeBuscar($query, $opcion_buscador, $buscador) {
        if($opcion_buscador != null) {
          return $query->where("$opcion_buscador", 'LIKE', "%$buscador%");
        }
      }
}
