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
            $table->UnsignedBigInteger('id_slot');
            $table->foreign('id_slot')->references('id')->on('slot');
            $table->UnsignedBigInteger('id_cable');
            $table->foreign('id_cable')->references('id')->on('cable');
            $table->UnsignedBigInteger('id_estado');
            $table->foreign('id_estado')->references('id')->on('estado');
            $table->string('sitio_fca')->nullable();
            $table->text('descripcion_fca')->nullable();
            $table->integer('olt')->nullable();
            $table->integer('spl')->nullable();
            $table->integer('filam')->nullable();
            $table->string('estado')->nullable();
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
            $table->dropColumn('id_slot');
            $table->dropColumn('id_cable');
            $table->dropColumn('id_estado');
        });
        Schema::dropIfExists('slot_msan');
    }
}
