<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEtiquetaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('etiqueta', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('ladoMSANLEFT');
            $table->text('ladoMSANRIGHT');
            $table->text('ladocabeceraLEFT');
            $table->text('ladocabeceraRIGHT');
            $table->unsignedBigInteger('id_cable');
            $table->integer('filam')->nullable();
            $table->foreign('id_cable')->references('id')->on('cable');
            $table->unsignedBigInteger('id_olt')->nullable();
            $table->foreign('id_olt')->references('id')->on('slot_msan');
            $table->integer('spl')->nullable();
            $table->text('sitio_fca')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('etiqueta', function (Blueprint $table) {
            $table->dropColumn('id_cable');
            $table->dropColumn('id_olt');
        });
        Schema::dropIfExists('etiqueta');
    }
}
