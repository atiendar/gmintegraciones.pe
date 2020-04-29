<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCotizacionArmadoTieneProductosTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('cotizacion_armado_tiene_productos', function (Blueprint $table) {
            $table->engine ='InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_producto')->comment('id del producto');
            $table->integer('cant')->unsigned()->comment('Cantidad de productos');
            $table->string('produc', 70)->comment('Nombre del producto');
            $table->string('sku',30)->comment('SKU');
            $table->decimal('prec_prove', 20,2)->unsigned()->comment('Precio del proveedor');
            $table->enum('utilid', ['.1','.2','.3','.4','.5','.6','.7','.8','.9'])->comment('Utilidad .1 = 10%
            .2 =20%, .3 = 30%, .4= 40%, .5 = 50%, .6 = 60%, .7= 70%, .8 = 80%, .9 = 90%');
            $table->unsignedBigInteger('armado_id');
            $table->foreign('armado_id')->references('id')->on('cotizacion_tiene_armados')->onUpdate('restrict')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cotizacion_armado_tiene_productos');
    }
}
