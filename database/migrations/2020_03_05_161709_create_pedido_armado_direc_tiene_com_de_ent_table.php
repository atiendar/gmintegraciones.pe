<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidoArmadoDirecTieneComDeEntTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedido_armado_direc_tiene_com_de_ent', function (Blueprint $table) {
            $table->engine ='InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->bigIncrements('id');
            $table->string('comp_ent_rut',200)->comment('Ruta comprobate');
            $table->string('comp_ent_nom',200)->comment('Nombre comprobate');
            $table->string('comp_cost_por_env_log_rut',200)->comment('Ruta comprobate');
            $table->string('comp_cost_por_env_log_nom',200)->comment('Nombre comprobate');
            $table->decimal('cost_por_env_log',20,2)->comment('Costo por envío logística');
            $table->unsignedBigInteger('direccion_id')->comment('Foreign Key');
            $table->foreign('direccion_id')->references('id')->on('pedido_armado_tiene_direcciones')->onUpdate('restrict')->onDelete('cascade');
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
        Schema::dropIfExists('pedido_armado_direc_tiene_com_de_ent');
    }
}
