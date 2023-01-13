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
        Schema::dropIfExists('cable');
    }
}
