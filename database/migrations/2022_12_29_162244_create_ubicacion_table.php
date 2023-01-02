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
            $table->text('link_gmaps')->nullable();
            $table->string('sitio_fca')->nullable();
            $table->text('descripcion_sitio')->nullable();
        });
        Schema::create('tecnologia', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nombre_tec');
        });
        Schema::create('slots_tec', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('slots');
            $table->UnsignedBigInteger('id_tecnologia');
            $table->foreign('id_tecnologia')->references('id')->on('tecnologia');

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
        Schema::table('slots_tec', function (Blueprint $table) {
            $table->dropColumn('id_tecnologia');
        });
        Schema::dropIfExists('ubicacion');
    }
}
