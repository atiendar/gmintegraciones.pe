<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pago extends Model{
    use SoftDeletes;
    protected $table='pagos';
    protected $primaryKey='id';
    public function pedido(){
        return $this->belongsTo('App\Models\Pedido')->orderBy('id','DESC');
    }
    public function factura(){
        return $this->hasOne('App\Models\Factura');
    }
}
