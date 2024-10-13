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
        Schema::create('clientes', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('nombre', 200)->nullable();
            $table->string('apellidoP', 200)->nullable();
            $table->string('apellidoM', 200)->nullable();
            $table->string('telefono', 15)->nullable();
            $table->date('fechaNac')->nullable();
            $table->integer('idRegistro')->nullable()->index('quienCreo');
            $table->dateTime('fechaRegistro')->nullable();
            $table->decimal('deuda', 10)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
};
