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
        Schema::create('tipopagos', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('tipo')->nullable();
        });

        DB::table('tipopagos')->insert([
            ['id' => 1, 'tipo' => 'Mes'],
            ['id' => 2, 'tipo' => 'Visita'],
            ['id' => 3, 'tipo' => 'Semana'],
            ['id' => 4, 'tipo' => 'Pago'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipopagos');
    }
};
