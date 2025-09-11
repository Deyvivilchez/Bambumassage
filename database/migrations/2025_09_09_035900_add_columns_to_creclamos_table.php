<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToCreclamosTable extends Migration
{
    public function up()
    {
        Schema::table('reclamos', function (Blueprint $table) {
            // Pedido que solicita el usuario (texto libre)
            $table->text('pedido')->nullable(); // ajusta el after(...) si quieres

            // Monto asociado al reclamo
            $table->decimal('monto', 10, 2)->nullable()->after('pedido');

            // Gestión del reclamo: fechas y textos
            $table->date('fecha_respuesta')->nullable()->after('monto');
            $table->text('respuesta')->nullable()->after('fecha_respuesta');

            $table->text('acuerdo_final')->nullable()->after('respuesta');
            $table->date('fecha_acuerdo_final')->nullable()->after('acuerdo_final');
        });
    }

    public function down()
    {
        Schema::table('reclamos', function (Blueprint $table) {
            $table->dropColumn([
                'pedido',
                'monto',
                'fecha_respuesta',
                'respuesta',
                'acuerdo_final',
                'fecha_acuerdo_final',
            ]);
        });
    }
}
