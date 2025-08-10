<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleventoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detallevento', function (Blueprint $table) {
            $table->bigIncrements('id_detalleevento');
            $table->foreignId('id_evento')->references('id_evento')->on('eventos');
            $table->foreignId('id_persona')->references('id_persona')->on('personas');
            $table->date('fecha_inscripcion');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detallevento');
    }
}
