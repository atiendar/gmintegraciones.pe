<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCotizacionArmadoTieneDireccionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cotizacion_armado_tiene_direcciones', function (Blueprint $table) {
            $table->engine ='InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->bigIncrements('id');
           
            $table->integer('cant')->unsigned()->default(0)->comment('Cantidad');
            $table->enum('met_de_entreg', config('opcionesSelect.select_metodo_de_entrega'))->comment('Método de entrega de ventas');
            $table->enum('est',config('opcionesSelect.select_estado'))->comment('Estado a la que se cotizo');
            $table->enum('for_loc', config('opcionesSelect.select_foraneo_local'))->comment('Foráneo o Local');
            $table->string('detalles_de_la_ubicacion',150)->comment('Detalles de la ubicación');
            $table->enum('tip_env', config('opcionesSelect.select_tipo_de_envio'))->default('Normal')->comment('Tipo de envío');
            $table->decimal('cost_por_env_individual',20,2)->unsigned()->nullable()->comment('Costo por envío venta');
            $table->decimal('cost_por_env',20,2)->unsigned()->nullable()->comment('Costo por envío venta');

            $table->unsignedBigInteger('armado_id')->comment('Foreign Key armados cotización');
            $table->foreign('armado_id')->references('id')->on('cotizacion_tiene_armados')->onUpdate('restrict')->onDelete('cascade');
            $table->string('created_at_dir',75)->comment('Correo del usuario que realizo el registro');
            $table->string('updated_at_dir', 75)->nullable()->comment('Correo del usuario que realizo la última modificación');
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
        Schema::dropIfExists('cotizacion_armado_tiene_direcciones');
    }
}
