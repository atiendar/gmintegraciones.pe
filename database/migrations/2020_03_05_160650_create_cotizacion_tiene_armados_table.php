<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCotizacionTieneArmadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cotizacion_tiene_armados', function (Blueprint $table) {
            $table->engine ='InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_armado');
            $table->integer('cant')->unsigned()->default(1)->comment('Cantidad');



            $table->string('img_rut',200)->nullable()->comment('Ruta imágen');
            $table->string('img_nom',200)->nullable()->comment('Nombre imágen');
            $table->string('tip', 150)->comment('Tipo');
            $table->string('nom',90)->comment('Nombre');
            $table->string('sku',60)->comment('SKU');
            $table->string('gama', 150)->comment('Gama');
            $table->decimal('pes',10,3)->unsigned()->comment('Peso');
            $table->decimal('alto', 10, 2)->unsigned()->comment('Alto');
            $table->decimal('ancho', 10, 2)->unsigned()->comment('Ancho');
            $table->decimal('largo', 10, 2)->unsigned()->comment('Largo');
            
            

        //    $table->decimal('prec_unit',20,2)->unsigned()->default(0.00)->comment('Precio unitario');
            $table->decimal('prec_redond', 20,2)->unsigned()->comment('Precio redondeado');
            $table->decimal('imp',20,2)->unsigned()->default(0.00)->comment('Importe');
            $table->unsignedBigInteger('cotizacion_id');
            $table->foreign('cotizacion_id')->references('id')->on('cotizaciones')->onUpdate('restrict')->onDelete('cascade');
            $table->string('created_at_arm',75)->nullable()->comment('Correo del usuario que realizo el registro');
            $table->string('updated_at_arm',75)->nullable()->comment('Correo del usuario que realizo la última modificación');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cotizacion_tiene_armados');
    }
}
