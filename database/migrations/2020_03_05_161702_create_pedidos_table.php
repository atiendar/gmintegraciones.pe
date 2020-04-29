<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->engine ='InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->bigIncrements('id');
            $table->string('serie',45)->unique()->comment('Serie');
            $table->string('ult_let',4)->default('A')->comment('Última letra');
        //    $table->enum('direc_de_arm',['Misma dirección','Diferente dirección'])->comment('Direcciones de armados'); 
            $table->integer('tot_de_arm')->default(0)->unsigned()->comment('Total de armados');
            $table->integer('arm_carg')->default(0)->unsigned()->comment('Armados cargados');
            $table->decimal('mont_tot_de_ped',20, 2)->unsigned()->comment('Monto total del pedido');
            $table->enum('entr_xprs',['Si','No'])->comment('Entrega express');
            $table->enum('urg',['Si','No'])->default('No')->comment('Urgente');
            $table->enum('foraneo',['Si','No'])->nullable()->comment('¿Es foráneo?'); 
            $table->enum('gratis',['Si','No'])->nullable()->comment('¿Sera gratis?'); 
            $table->string('cot_fin_de_client_rut',200)->nullable()->comment('Ruta de la cotizacion final del cliente');
            $table->string('cot_fin_de_client_nom',200)->nullable()->comment('Nombre de la cotizacion final del cliente');
            $table->date('fech_de_entreg')->nullable()->comment('Fecha de entrega');
            $table->enum('se_pued_entreg_ant',['Si','No'])->nullable()->comment('¿Se puede entregar antes?');
            $table->integer('cuant_dia_ant')->unsigned()->nullable()->comment('¿Cuántos días antes?'); 
            $table->text('coment_client')->nullable()->comment('Comentarios cliente');
            $table->string('estat_vent_gen',100)->default('Falta Información general')->comment('Estatus de venta 1');
            $table->string('estat_vent_arm',100)->default('Falta cargar armado(s)')->comment('Estatus de venta 2');
            $table->string('estat_vent_dir',100)->default('Falta asignar dirección(es) armado(s)')->comment('Estatus de venta 3');
            $table->text('coment_vent')->nullable()->comment('Comentarios venta');
            $table->string('estat_fact',100)->default('No solicitada')->comment('Estatus factura');
            $table->string('estat_pag',100)->default('Pendiente')->comment('Estatus de pago');
            $table->string('lid_de_ped_alm',80)->nullable()->comment('Personas que recibe en almacen');
            $table->string('estat_alm',100)->default('Pendiente')->comment('Estatus almacen');
            $table->timestamp('fech_estat_alm')->nullable()->comment('Fecha estatus almacen');
            $table->text('coment_alm')->nullable()->comment('Comentarios Almacen');
            $table->string('lid_de_ped_produc',80)->nullable()->comment('Líder de pedido del producto'); 
            $table->string('estat_produc',100)->default('Pendiente')->comment('Estatus del producto');
            $table->timestamp('fech_estat_produc')->nullable()->comment('Fecha estatus producto');
            $table->text('coment_produc')->nullable()->comment('Comentarios producción');
            $table->string('lid_de_ped_log',80)->nullable()->comment('Lider pedido logística');
            $table->string('estat_log',100)->default('Pendiente')->comment('Estatus logística');
            $table->timestamp('fech_estat_log')->nullable()->comment('Fecha estatus logística');
            $table->text('coment_log')->nullable()->comment('Comentarios logística');
            $table->unsignedBigInteger('user_id')->comment('Foreign Key usuario');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('restrict')->onDelete('cascade');
            $table->string('asignado_ped',75)->comment('Correo del usuario al que se le asigno este registro');
            $table->string('created_at_ped',75)->comment('Correo del usuario que realizo el registro');
            $table->string('updated_at_ped',75)->nullable()->comment('Correo del usuario que realizo la última modificación');
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
        Schema::dropIfExists('pedidos');
    }
}
