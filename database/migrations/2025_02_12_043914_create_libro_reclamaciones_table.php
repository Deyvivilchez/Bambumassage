<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLibroReclamacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reclamos', function (Blueprint $table) {
            $table->bigIncrements('id_reclamo');
            $table->foreignId('id_persona')->references('id_persona')->on('personas');
            $table->string('codigo_reclamo')->unique(); // Código único para cada reclamo
            $table->string('tipo_documento');
            $table->string('num_documento');
            $table->text('detalle');
            $table->string('estado')->default('pendiente');
            $table->date('fecha_reclamo');
            $table->string('producto_servicio');
            $table->string('tipo_reclamo')->nullable();
            $table->timestamps();
            $table->softDeletes(); // Eliminación lógica
        });






    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reclamos');
    }
}
