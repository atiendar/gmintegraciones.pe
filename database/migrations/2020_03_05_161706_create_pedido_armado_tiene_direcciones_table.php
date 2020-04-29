<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidoArmadoTieneDireccionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedido_armado_tiene_direcciones', function (Blueprint $table) {
            $table->engine ='InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->bigIncrements('id');            
            $table->integer('cant')->unsigned()->comment('Cantidad');
            $table->string('ciud_a_la_q_se_cotiz',150)->comment('Ciudad a la que se cotiza');
            $table->string('met_de_entreg_de_vent', 150)->comment('Método de entrega de ventas');
            $table->string('tip_env',150)->nullable()->comment('Tipo de envío');
            $table->decimal('cost_por_env_vent',20,2)->unsigned()->nullable()->comment('Costo por envío venta');
        //    $table->string('ref_gral_de_ubic_entreg',500)->nullable()->comment('Referencia general de ubicación de entrega');
            $table->string('met_de_entreg_de_log',60)->nullable()->comment('Método de entrega de logística');
            $table->string('met_de_entreg_esp_de_log',100)->nullable()->comment('Método de entrega espesifico de logística');
            $table->string('comp_de_sal_rut', 200)->nullable()->comment('Ruta de donde se guardo el comprobante');
            $table->string('comp_de_sal_nom', 200)->nullable()->comment('Nombre del comprobante');
            $table->string('url',200)->nullable()->comment('URL');
            $table->string('num_guia',60)->nullable()->comment('Número de guía');
            $table->string('nom_ref_uno',80)->comment('Nombre referencia uno');
            $table->string('nom_ref_dos',80)->nullable()->comment('Nombre referencia dos');
            $table->string('lad_fij',4)->nullable()->comment('Lada del teléfono fijo');
            $table->string('tel_fij',15)->nullable()->comment('Teléfono fijo');
            $table->string('ext',10)->nullable()->comment('Extensión');
            $table->string('lad_mov',4)->comment('Lada del teléfono móvil');
            $table->string('tel_mov',15)->comment('Teléfono móvil');
            $table->string('calle',45)->comment('Calle');
            $table->string('no_ext',8)->comment('Número exterior');
            $table->string('no_int',30)->nullable()->comment('Número interior');
            $table->string('pais',40)->comment('País');
            $table->string('ciudad',50)->comment('Ciudad');
            $table->string('col',40)->comment('Colonia');
            $table->string('del_o_munic',50)->comment('Delegación o Municipio');
            $table->string('cod_post',6)->comment('Código Postal');
            $table->text('ref_zon_de_entreg')->nullable()->comment('Referencia zona de entrega');
            $table->unsignedBigInteger('pedido_armado_id')->comment('Foreign Key arcones pedidos');
            $table->foreign('pedido_armado_id')->references('id')->on('pedido_armados')->onUpdate('restrict')->onDelete('cascade');
            $table->string('asignado_direc_arm',75)->comment('Correo del usuario al que se le asigno este registro');
            $table->string('created_at_direc_arm',75)->comment('Correo del usuario que realizo el registro');
            $table->string('updated_at_direc_arm',75)->nullable()->comment('Correo del usuario que realizo la última modificación');
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
        Schema::dropIfExists('pedido_armado_tiene_direcciones');
    }
}
