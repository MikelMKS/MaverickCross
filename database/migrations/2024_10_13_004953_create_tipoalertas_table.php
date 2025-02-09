<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipoalertas', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('nombre')->nullable();
            $table->string('icono')->nullable();
            $table->string('texto')->nullable();
        });

        DB::table('tipoalertas')->insert([
            ['id' => 1, 'nombre' => 'CUMPLEAÑOS', 'icono' => 'ri-cake-2-line text-success', 'texto' => '¡Hoy es el cumpleaños de pesosdata clientes!'],
            ['id' => 2, 'nombre' => 'FIN MES', 'icono' => 'ri-calendar-check-line text-danger', 'texto' => 'Hay pesosdata membresias mensuales que han expirado'],
            ['id' => 3, 'nombre' => 'FIN SEMANA', 'icono' => 'ri-map-pin-time-line text-warning', 'texto' => 'pesosdata personas han finalizado su membresia semanal'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipoalertas');
    }
};
