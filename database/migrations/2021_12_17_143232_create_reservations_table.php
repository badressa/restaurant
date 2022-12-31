<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->time('heure_debut');
            $table->date('heure_fin');
            $table->date('date_reservation');
            $table->smallInteger('nbrpersonne');
            $table->smallInteger('status')->default(0)->comment('0:reservé 1:servi');
            $table->boolean('payee')->default(0);
            $table->integer('client_id')->nullable()->comment('client_id==user_id');
            $table->integer('table_id');
            $table->integer('command_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}
