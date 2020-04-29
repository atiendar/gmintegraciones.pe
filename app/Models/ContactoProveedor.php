<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactoProveedor extends Model {
    use SoftDeletes; // Permite habilitar el campo deleted_at en la BD para no eliminar el registro directamente y trabajar sobre una papelera de reciclaje
    protected $table = 'contactos_proveedor';
    protected $primaryKey = 'id';

    public function proveedor() {
        return $this->belongsTo('App\Models\Proveedor')->orderBy('id', 'DESC');
    }
}