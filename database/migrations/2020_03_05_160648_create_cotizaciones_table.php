<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCotizacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cotizaciones', function (Blueprint $table) {
            $table->engine ='InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->bigIncrements('id');
            $table->string('serie',45)->unique()->comment('Serie');
            $table->date('valid')->comment('Fecha de validez');
            $table->string('email_cliente',75)->comment('Correo del cliente que solicita la cotización');
            $table->decimal('desc',20,2)->unsigned()->default(0.00)->comment('Descuento');
            $table->decimal('sub_total', 20,2)->unsigned()->default(0.00)->comment('Sub total');
            $table->decimal('iva', 20,2)->unsigned()->default(0.00)->comment('IVA');
            $table->decimal('tot', 20,2)->unsigned()->default(0.00)->comment('Precio total');
            $table->string('asignado_cot', 75)->comment('Correo del usuario al qu se le asigno este registro');
            $table->string('created_at_cot',75)->comment('Correo del usuario que realizo el registro');
            $table->string('updated_at_cot',75)->nullable()->comment('Correo del usuario que realizo la última modificación');
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
        Schema::dropIfExists('cotizaciones');
    }
}
