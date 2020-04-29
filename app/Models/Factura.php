<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Factura extends Model{
    use SoftDeletes;
    protected $table='facturas';
    protected $primaryKey='id';
    
    public function pago(){
        return $this->belongsTo('App\Models\Pago');
    }
}
