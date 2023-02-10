<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMufasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mufas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->integer('item')->nullable();
            $table->unsignedBigInteger('id_cable')->nullable();
            $table->foreign('id_cable')->references('id')->on('cable');
            $table->string('distancia_k')->nullable();
            $table->string('ruta5_k')->nullable();
            $table->string('ubicacion')->nullable();
            $table->string('latitud')->nullable();
            $table->string('longitud')->nullable();
            $table->text('observaciones')->nullable();
            $table->text('link_gmaps')->nullable();
            $table->date('fecha')->nullable();
        });
        Schema::table('alertas', function($table) {
            $table->unsignedBigInteger('id_mufa')->nullable();
            $table->foreign('id_mufa')->references('id')->on('mufas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mufas', function (Blueprint $table) {
            $table->dropColumn('id_cable');
        });
        Schema::dropIfExists('mufas');
    }
}
