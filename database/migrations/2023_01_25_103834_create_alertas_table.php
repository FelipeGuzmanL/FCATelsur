<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlertasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gravedad_alerta', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('gravedad');
        });
        Schema::create('alertas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('id_gravedad');
            $table->foreign('id_gravedad')->references('id')->on('gravedad_alerta');
            $table->unsignedBigInteger('id_olt')->nullable();
            $table->foreign('id_olt')->references('id')->on('slot_msan');
            $table->unsignedBigInteger('id_detallecable')->nullable();
            $table->foreign('id_detallecable')->references('id')->on('detallecable');
            $table->text('observacion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('alertas', function (Blueprint $table) {
            $table->dropColumn('id_gravedad');
            $table->dropColumn('id_olt');
            $table->dropColumn('id_detallecable');
            $table->dropColumn('id_mufa');
        });
        Schema::dropIfExists('alertas');
    }
}
