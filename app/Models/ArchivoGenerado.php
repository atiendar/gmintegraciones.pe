<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArchivosGenerados extends Model {
    use SoftDeletes; // Permite habilitar el campo deleted_at en la BD para no eliminar el registro directamente y trabajar sobre una papelera de reciclaje
    protected $table = 'archivos_generados';
    protected $primaryKey = 'id';
}