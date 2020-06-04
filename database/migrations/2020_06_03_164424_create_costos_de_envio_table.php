<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCostosDeEnvioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('costos_de_envio', function (Blueprint $table) {
        $table->engine ='InnoDB';
        $table->charset = 'utf8mb4';
        $table->collation = 'utf8mb4_unicode_ci';
        $table->bigIncrements('id');

        $table->string('met_de_entreg', 150)->comment('Método de entrega');
        $table->string('est',150)->comment('Estado');
        $table->enum('for_loc', ['Foráneo', 'Local'])->comment('Tipo de envío');
        $table->enum('tip_env', ['Normal', 'Express'])->comment('Tipo de envío');
        $table->decimal('cost_por_env',20,2)->unsigned()->comment('Costo por envío');

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
        Schema::dropIfExists('costos_de_envio');
    }
}
