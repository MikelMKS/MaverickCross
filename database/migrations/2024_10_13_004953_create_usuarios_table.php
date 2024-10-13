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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('user', 20)->nullable();
            $table->string('pass', 20)->nullable();
            $table->integer('idTipo')->nullable()->index('tipousuarios');
            $table->string('nombre', 100)->nullable();
            $table->integer('estatus')->nullable()->comment('0=inactivo,1=activo,2 = eliminado');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
};
