<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMantencionesmsanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comprobar', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('comprobar');
        });
        Schema::create('mantencionesmsan', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('id_msan');
            $table->foreign('id_msan')->references('id')->on('equipos_msan');
            $table->unsignedBigInteger('id_usuario');
            $table->foreign('id_usuario')->references('id')->on('users');
            $table->date('fecha_mantencion')->nullable();
            $table->string('comprobacion_1')->nullable();
            $table->string('comprobacion_2')->nullable();
            $table->string('comprobacion_3')->nullable();
            $table->string('comprobacion_4')->nullable();
            $table->string('comprobacion_5')->nullable();
            $table->string('comprobacion_6')->nullable();
            $table->string('comprobacion_7')->nullable();
            $table->string('comprobacion_8')->nullable();
            $table->string('comprobacion_9')->nullable();
            $table->string('comprobacion_10')->nullable();
            $table->string('comprobacion_11')->nullable();
            $table->text('observaciones')->nullable();
            $table->string('numero_ticket')->nullable();
            $table->string('coordenadas')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mantencionesmsan', function (Blueprint $table) {
            $table->dropColumn('id_msan');
            $table->dropColumn('id_comprobar');
            $table->dropColumn('id_usuario');
        });
        Schema::dropIfExists('mantencionesmsan');
    }
}
