<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCruzada1Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cruzada1', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('id_fil1')->nullable();
            $table->foreign('id_fil1')->references('id')->on('detallecable');
            $table->unsignedBigInteger('id_fil2')->nullable();
            $table->foreign('id_fil2')->references('id')->on('detallecable');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cruzada1');
    }
}
