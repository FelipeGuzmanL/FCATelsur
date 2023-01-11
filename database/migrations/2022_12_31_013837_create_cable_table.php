<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cable', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nombre_cable');
            $table->integer('cant_filam')->nullable();
            $table->UnsignedBigInteger('id_tipo_cable')->nullable();
            $table->foreign('id_tipo_cable')->references('id')->on('tipo_cable');
            $table->UnsignedBigInteger('id_sitio');
            $table->foreign('id_sitio')->references('id')->on('ciudad');
            $table->text('descripcion')->nullable();
        });
        Schema::create('detallecable', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('filamento')->nullable();
            $table->string('direccion')->nullable();
            $table->UnsignedBigInteger('id_cable');
            $table->foreign('id_cable')->references('id')->on('cable');
            $table->UnsignedBigInteger('id_estado');
            $table->foreign('id_estado')->references('id')->on('estado');
            $table->UnsignedBigInteger('id_usuario')->nullable();
            $table->foreign('id_usuario')->references('id')->on('users');
            $table->text('servicio')->nullable();
            $table->text('cruzada')->nullable();
            $table->integer('longitud')->nullable();
            $table->text('gmaps')->nullable();
            $table->text('observaciones')->nullable();
            $table->string('ocupacion')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cable', function (Blueprint $table) {
            $table->dropColumn('id_ubicacion');
            $table->dropColumn('id_tipo_cable');
        });
        Schema::table('detallecable', function (Blueprint $table) {
            $table->dropColumn('id_estado');
            $table->dropColumn('id_cable');
            $table->dropColumn('id_usuario');
        });
        Schema::dropIfExists('cable');
    }
}
