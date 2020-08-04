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

        $table->enum('tip_emp',config('opcionesSelect.select_tipo_de_empaque'))->comment('Tipo de empaque');
        $table->enum('seg',config('opcionesSelect.select_si_no'))->comment('Cuenta con seguro');
        $table->string('tiemp_ent', 20)->comment('Tiempo de entrega en minutos');
        $table->enum('met_de_entreg', config('opcionesSelect.select_metodo_de_entrega'))->comment('Método de entrega');
        $table->enum('est',config('opcionesSelect.select_estado'))->comment('Estado');
        $table->enum('for_loc', config('opcionesSelect.select_foraneo_local'))->comment('Foráneo o Local');
        $table->enum('tip_env', config('opcionesSelect.select_tipo_de_envio_plus'))->comment('Tipo de envío');
        $table->decimal('cost_por_env',20,2)->unsigned()->comment('Costo por envío');

        $table->string('asignado_env', 75)->comment('Correo del usuario al qu se le asigno este registro');
        $table->string('created_at_env',75)->comment('Correo del usuario que realizo el registro');
        $table->string('updated_at_env',75)->nullable()->comment('Correo del usuario que realizo la última modificación');
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
