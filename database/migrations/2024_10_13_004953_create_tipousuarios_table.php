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
        Schema::create('tipousuarios', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('tipo', 50)->nullable();
        });

        DB::table('tipousuarios')->insert([
            ['id' => 1, 'tipo' => 'Admin'],
            ['id' => 2, 'tipo' => 'Usuario'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipousuarios');
    }
};
