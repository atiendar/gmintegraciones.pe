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
           
            $table->enum('tip_emp',config('opcionesSelect.select_tipo_de_empaque'))->comment('Tipo de empaque');
            $table->enum('seg',config('opcionesSelect.select_si_no'))->comment('Cuenta con seguro');
            $table->string('tiemp_ent', 25)->comment('Tiempo de entrega en dias');
            $table->integer('cant')->unsigned()->default(0)->comment('Cantidad');
            $table->string('met_de_entreg', 150)->comment('Método de entrega de ventas');
            $table->string('est',150)->comment('Estado a la que se cotizó');
            $table->enum('for_loc', config('opcionesSelect.select_foraneo_local'))->comment('Foráneo o Local');
            $table->string('detalles_de_la_ubicacion',150)->comment('Detalles de la ubicación');
            $table->string('tip_env', 80)->nullable()->comment('Tipo de envío');
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
