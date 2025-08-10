<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Tabla de categorías
        Schema::create('faqs_categoria', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        // Tabla de subcategorías
        Schema::create('faqs_subcategoria', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion')->nullable();
            $table->foreignId('id_categoria')->constrained('faqs_categoria')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });

        // Tabla de preguntas y respuestas
        Schema::create('faqs', function (Blueprint $table) {
            $table->id();
            $table->text('pregunta');
            $table->text('respuesta');
            $table->foreignId('id_subcategoria')->constrained('faqs_subcategoria')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
            // Índice Full-Text
            $table->fullText(['pregunta', 'respuesta']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('faqs');
        Schema::dropIfExists('faqs_subcategoria');
        Schema::dropIfExists('faqs_categoria');
    }
}
