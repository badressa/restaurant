<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIngredientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingredients', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->integer('quantite_unite');
            $table->integer('prix_unitaire');
            $table->string('unite');
            $table->integer('quantite_endommage')->default(0);
            $table->integer('quantite_consomme')->default(0);
            $table->boolean('status')->default(0);
            $table->integer('idfacture')->nullable();
            $table->date('finished_at')->nullable();
            $table->string('categorie')->nullable();
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
        Schema::dropIfExists('ingredients');
    }
}
