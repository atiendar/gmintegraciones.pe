<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidoArmadoDirecTieneComprobantes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedido_armado_direc_tiene_comprobantes', function (Blueprint $table) {
            $table->engine ='InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->bigIncrements('id');

            $table->integer('cant')->unsigned()->comment('Cantidad');
            $table->string('estat',70)->default(config('app.en_ruta'))->comment('Estatus');

            $table->string('met_de_entreg_de_log',150)->comment('Método de entrega de logística');
            $table->string('met_de_entreg_de_log_esp',150)->nullable()->comment('Método de entrega espesifico de logística');
            $table->string('comp_de_sal_rut', 200)->nullable()->comment('Ruta de donde se guardo el comprobante de salida');
            $table->string('comp_de_sal_nom', 200)->nullable()->comment('Nombre del comprobante de salida');
            $table->string('url',200)->nullable()->comment('URL rastreo');
            $table->string('num_guia',60)->nullable()->comment('Número de guía');

            $table->string('comp_ent_rut',200)->nullable()->comment('Ruta comprobate');
            $table->string('comp_ent_nom',200)->nullable()->comment('Nombre comprobate');
            $table->string('comp_cost_por_env_log_rut',200)->nullable()->comment('Ruta comprobate');
            $table->string('comp_cost_por_env_log_nom',200)->nullable()->comment('Nombre comprobate');
            $table->decimal('cost_por_env_log',20,2)->nullable()->comment('Costo por envío logística');

            $table->unsignedBigInteger('direccion_id')->comment('Foreign Key');
            $table->foreign('direccion_id')->references('id')->on('pedido_armado_tiene_direcciones')->onUpdate('restrict')->onDelete('cascade');
            $table->string('created_at_comp', 75)->comment('Correo del usuario que realizo el registro');
            $table->string('updated_at_comp', 75)->nullable()->comment('Correo del usuario que realizo la última modificación');
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
        Schema::dropIfExists('pedido_armado_direc_tiene_comprobantes');
    }
}
