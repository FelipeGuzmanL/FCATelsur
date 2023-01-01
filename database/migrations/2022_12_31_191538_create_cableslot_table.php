<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCableslotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cableslot', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->UnsignedBigInteger('id_slot');
            $table->foreign('id_slot')->references('id')->on('slot_msan');
            $table->UnsignedBigInteger('id_cable');
            $table->foreign('id_cable')->references('id')->on('cable');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cableslot', function (Blueprint $table) {
            $table->dropColumn('id_slot');
            $table->dropColumn('id_cable');
        });
        Schema::dropIfExists('cableslot');
    }
}
