<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facturas', function (Blueprint $table) {
            $table->engine ='InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->bigIncrements('id');
            $table->string('serie',20)->comment('Serie');
            $table->string('est_fact',50)->default('Pendiente')->comment('Estatus Factura');
           
            $table->string('nom_o_raz_soc',60)->comment('Nombre o razón social');
            $table->string('rfc',20)->comment('RFC');
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
           
            $table->enum('preg',['Si', 'No'])->comment('Pregunta: ¿La factura es necesaria para generar anticipo?');
            $table->enum('uso_de_cfdi',[
                'G01 Adquisición de mercancias',
                'G02 Devoluciones, descuentos o bonificaciones',
                'G03 Gastos en general',
                'P01 Por definir',
                'I01 Construcciones', 
                'I02 Mobiliario y equipo de oficina por inversiones',
                'I03 Equipo de transporte',
                'I04 Equipo de cómputo y accesorios',
                'I05 Dados, troqueles, matrices y herramientas',
                'I06 Comunicaciones telefónicas',
                'I07 Comunicaciones satelitales',
                'I08 Otra maquinaria y equipo',
                'D01 Honorarios médicos, dentales y gastos hospitalarios',
                'D02 Gastos médicos por incapacidad o discapacidad',
                'D03 Gastos funerales',
                'D04 Donativos', 
                'D05 Intereses reales efectivamente pagados por créditos hipotecarios (casa habitación)',
                'D06 Aportaciones voluntarias al SAR', 
                'D07 Primas por seguros de gastos médicos',
                'D08 Gastos de transportación escolar obligatoria',
                'D09 Depósitos en cuentas para el ahorro, primas que tengan como base planes de pensiones',
                'D10 Pagos por servicios educativos (colegiaturas)'])->comment('Uso de CFDI');
            $table->enum('met_de_pag',['PUE Pago en una sola exhibición','PUE Pago en parciales o diferido'])->comment('Método de pago');
            $table->enum('form_de_pag',[
                '01 Efectivo',
                '02 Cheque nominativo',
                '03 Transferencia electrónica de fondos',
                '04 Tarjeta de crédito',
                '05 Monedero electrónico',
                '06 Dinero electrónico',
                '08 Vales de despensa',
                '12 Dcaión de pago',
                '13 Pago por subrogación',
                '14 Pago por consignación',
                '15 Condonación',
                '17 Compensación',
                '23 Novación',
                '24 Confusión',
                '25 Remisión de deuda',
                '26 Prescripción o caducidad',
                '27 A satisfacción del acreedor',
                '28 Tarjeta de débito',
                '29 Tarjeta de servicios',
                '30 Aplicación de anticipos',
                '99 Por definir'])->comment('Forma de pago');
            $table->string('banc_de_cuent_de_retir',5)->nullable()->comment('Banco de cuenta de retiro');
            $table->string('ulti_cuatro_dig_cuent_de_retir',4)->nullable()->comment('Últimos cuatro dígitos de la cuenta de retiro');
        //    $table->decimal('mont_a_fact',20, 2)->unsigned()->comment('Monto a facturar');

            $table->enum('concept',['Arcon Navideño','Canastas Navideñas','Despensas','Regalo de fin de año'])->comment('Concepto');
            $table->text('coment_u_obs_us')->nullable()->comment('Comentarios u Observaciones del usuario');
            $table->text('coment_admin')->nullable()->comment('Comentarios del administrador');
           
            $table->string('fact_pdf_rut',200)->nullable()->comment('Ruta de la factura PDF');
            $table->string('fact_pdf_nom',200)->nullable()->comment('Nombre de la factura PDF');
            $table->string('fact_xlm_rut',200)->nullable()->comment('Ruta de la factura XLM');
            $table->string('fact_xlm_nom',200)->nullable()->comment('Nombre de la factura XLM');
            $table->string('ppd_pdf_rut',200)->nullable()->comment('Ruta de Pago en Parcialidades o Diferido PDF');
            $table->string('ppd_pdf_nom',200)->nullable()->comment('Nombre de Pago en Parcialidades o Diferido PDF');
            $table->string('ppd_xlm_rut',200)->nullable()->comment('Ruta de Pago en Parcialidades o Diferido XLM');
            $table->string('ppd_xlm_nom',200)->nullable()->comment('Nombre de Pago en Parcialidades o Diferido XLM');

            $table->unsignedBigInteger('pago_id')->comment('Foreign Key del código de pago');
            $table->foreign('pago_id')->references('id')->on('pagos')->onUpdate('restrict')->onDelete('cascade');
            $table->string('created_at_fact',75)->comment('Correo del usuario que realizo el registro');
            $table->string('updated_at_fact',75)->nullable()->comment('Correo del usuario que realizo la última modificación');
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
        Schema::dropIfExists('facturas');
    }
}
