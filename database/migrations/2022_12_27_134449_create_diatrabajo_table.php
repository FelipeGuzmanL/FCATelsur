<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiatrabajoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diatrabajo', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('hora_salida');
            $table->date('hora_entrada');
            $table->float('km_salida');
            $table->float('km_entrada');
            $table->UnsignedBigInteger('id_vehiculo');
            $table->foreign('id_vehiculo')->references('id')->on('vehiculo');
            $table->float('litros');
            $table->float('gasto_pesos');
            $table->string('guia');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('diatrabajo', function (Blueprint $table) {
            $table->dropColumn('id_vehiculo');
        });
        Schema::dropIfExists('diatrabajo');
    }
}
