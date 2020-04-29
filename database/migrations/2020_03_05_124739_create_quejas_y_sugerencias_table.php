<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuejasYSugerenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('quejas_y_sugerencias', function (Blueprint $table) {
            $table->engine ='InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->bigIncrements('id');
            $table->string('depto', 70)->comment('Departamento');
            $table->text('obs')->nullable()->comment('Observaciones');
            $table->string('asignado_quej_y_sug', 75)->nulable()->comment('Correo del usuario al que se le asigno este registro');
            $table->string('create_at_quej_y_sug', 75)->nullable()->comment('Correo del usuario que realizo el registro');
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
        Schema::dropIfExists('quejas_y_sugerencias');
    }
}
