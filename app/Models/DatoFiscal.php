<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DatoFiscal extends Model{
    use SoftDeletes;
    protected $table='datos_fiscales';
    protected $primaryKey='id';

    public function user(){
        return $this->belongsTo('App\User')->orderBy('id','DESC');
    }
}
