<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubPago extends Model {
    use SoftDeletes;
    protected $table='sub_pagos';
    protected $primaryKey='id';
    public function pago(){
        return $this->belongsTo('App\Models\Pago')->orderBy('id','DESC');
    }
}
