<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slot', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->UnsignedBigInteger('id_msan');
            $table->foreign('id_msan')->references('id')->on('equipos_msan');
            $table->UnsignedBigInteger('id_estado');
            $table->foreign('id_estado')->references('id')->on('estado');
            $table->string('slot_msan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('slot', function (Blueprint $table) {
            $table->dropColumn('id_msan');
            $table->dropColumn('id_estado');
        });
        Schema::dropIfExists('slot');
    }
}
