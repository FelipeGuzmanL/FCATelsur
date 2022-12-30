<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlotMsanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slot_msan', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->UnsignedBigInteger('id_msan');
            $table->foreign('id_msan')->references('id')->on('equipos_msan');
            $table->integer('olt');
            $table->string('sitio_fca');
            $table->integer('spl');
            $table->text('descripcion_sitio');
            $table->string('cable');
            $table->integer('filam');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('slot_msan', function (Blueprint $table) {
            $table->dropColumn('id_msan');
        });
        Schema::dropIfExists('slot_msan');
    }
}
