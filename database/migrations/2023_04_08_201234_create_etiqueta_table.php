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
            $table->text('etiqueta');
            $table->unsignedBigInteger('id_cable');
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
        Schema::table('etiqueta', function (Blueprint $table) {
            $table->dropColumn('id_cable');
        });
        Schema::dropIfExists('etiqueta');
    }
}
