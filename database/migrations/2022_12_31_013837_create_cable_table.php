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
            $table->integer('cant_minitubos')->nullable();
            $table->UnsignedBigInteger('id_sitio');
            $table->foreign('id_sitio')->references('id')->on('ciudad');
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
        });
        Schema::dropIfExists('cable');
    }
}
