<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUbicacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ubicacion', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->UnsignedBigInteger('id_ciudad');
            $table->foreign('id_ciudad')->references('id')->on('ciudad');
            $table->string('direccion')->nullable();
            $table->string('coordenadas')->nullable();
            $table->text('link-gmaps')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ubicacion', function (Blueprint $table) {
            $table->dropColumn('id_ciudad');
        });
        Schema::dropIfExists('ubicacion');
    }
}
