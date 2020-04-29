<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->engine ='InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->bigIncrements('id');
            $table->string('serie',20)->comment('Serie');
            $table->string('cod_fact',50)->unique()->comment('Código de facturación');
            $table->string('comp_de_pag_rut',200)->comment('Ruta de comprobante de pagos');
            $table->string('comp_de_pag_nom',200)->comment('Nombre de comprobante de pagos');
            $table->string('cop_de_pag_nom_rut',200)->nullable()->comment('Ruta de la copia de identificación');
            $table->string('cop_de_pag_nom_nom',200)->nullable()->comment('Nombre de la copia de identificación');
            $table->string('estat_pag',100)->default('Pendiente')->nullable()->comment('Estatus de pago');
            $table->decimal('mont_de_pag',20,2)->unsigned()->comment('Monto de pago');
            $table->string('tipo',20)->comment('Tipo');
            $table->string('form_de_pag',40)->comment('Forma de pago');
            $table->text('coment_pag')->nullable()->comment('Comentarios pagos');

            $table->unsignedBigInteger('pedido_id')->comment('Foreign Key del código de factura');
            $table->foreign('pedido_id')->references('id')->on('pedidos')->onUpdate('restrict')->onDelete('cascade');

            $table->string('created_at_pag',75)->nullable()->comment('Correo del usuario que realizo el registro');
            $table->string('updated_at_pag',75)->nullable()->comment('Correo del usuario que realizo la última modificación');

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
        Schema::dropIfExists('pagos');
    }
}
