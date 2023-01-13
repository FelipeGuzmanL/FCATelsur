<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetallecableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
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
            $table->UnsignedBigInteger('id_olt')->nullable();
            $table->foreign('id_olt')->references('id')->on('slot_msan');
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
        Schema::table('detallecable', function (Blueprint $table) {
            $table->dropColumn('id_estado');
            $table->dropColumn('id_cable');
            $table->dropColumn('id_usuario');
            $table->dropColumn('id_olt');
        });
        Schema::dropIfExists('detallecable');
    }
}
