<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyFaqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('faqs', function (Blueprint $table) {
            // Quitar FK temporalmente para poder modificarla
            $table->dropForeign(['id_subcategoria']);
            // Hacer nullable la subcategoría
            $table->unsignedBigInteger('id_subcategoria')->nullable()->change();
            $table->foreign('id_subcategoria')->references('id')->on('faqs_subcategoria')->onDelete('cascade');

            // Agregar la FK a categoría directamente (también nullable)
            $table->foreignId('id_categoria')->nullable()->constrained('faqs_categoria')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('faqs', function (Blueprint $table) {
            // Quitar la FK a categoría
            $table->dropForeign(['id_categoria']);
            $table->dropColumn('id_categoria');

            // Revertir subcategoría a NOT NULL si lo deseas
            $table->dropForeign(['id_subcategoria']);
            $table->unsignedBigInteger('id_subcategoria')->nullable(false)->change();
            $table->foreign('id_subcategoria')->references('id')->on('faqs_subcategoria')->onDelete('cascade');
        });
    }
}
