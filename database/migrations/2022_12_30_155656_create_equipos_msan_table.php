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
            $table->UnsignedBigInteger('id_ubicacion');
            $table->foreign('id_ubicacion')->references('id')->on('ubicacion');
            $table->UnsignedBigInteger('id_sitio');
            $table->foreign('id_sitio')->references('id')->on('ciudad');
            $table->integer('numero');
            $table->string('tecnologia');
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
            $table->dropColumn('id_ubicacion');
            $table->dropColumn('id_sitio');
        });
        Schema::dropIfExists('equipos_msan');
    }
}
