<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArconPedidoDireccion extends Model{
    use SoftDeletes;
    protected $table='arcones_pedidos_direcciones';
    protected $primaryKey='id';
}