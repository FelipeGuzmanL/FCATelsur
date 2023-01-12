<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCableSlotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cable_slot', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('slot_id');
            $table->foreign('slot_id')->references('id')->on('slot')->onDelete('cascade');
            $table->unsignedBigInteger('cable_id');
            $table->foreign('cable_id')->references('id')->on('cable')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cable_slot', function (Blueprint $table) {
            $table->dropColumn('id_slot');
            $table->dropColumn('id_cable');
        });
        Schema::dropIfExists('cable_slot');
    }
}
