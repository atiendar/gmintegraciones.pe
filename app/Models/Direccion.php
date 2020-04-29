<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Direccion extends Model{
    use SoftDeletes;
    protected $table='direcciones';
    protected $primaryKey='id';

    public function user(){
        return $this->belongsTo('App\User')->orderBy('id','DESC');
    }
}
