<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquiposMsanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipos_msan', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->UnsignedBigInteger('id_usuario')->nullable();
            $table->foreign('id_usuario')->references('id')->on('ubicacion');
            $table->UnsignedBigInteger('id_ubicacion');
            $table->foreign('id_ubicacion')->references('id')->on('ubicacion');
            $table->UnsignedBigInteger('id_sitio');
            $table->foreign('id_sitio')->references('id')->on('ciudad');
            $table->UnsignedBigInteger('id_tecnologia');
            $table->foreign('id_tecnologia')->references('id')->on('tecnologia');
            $table->integer('numero');
        });
        Schema::create('estado', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('estado');
        });
        Schema::create('tipo_cable', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('tipo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('equipos_msan', function (Blueprint $table) {
            $table->dropColumn('id_usuario');
            $table->dropColumn('id_ubicacion');
            $table->dropColumn('id_sitio');
            $table->dropColumn('id_tecnologia');
        });
        Schema::dropIfExists('equipos_msan');
    }
}
