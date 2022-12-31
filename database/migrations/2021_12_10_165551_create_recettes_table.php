<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecettesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recettes', function (Blueprint $table) {
            $table->id();
            $table->string('libelle');
            $table->string('photo')->nullable();
            $table->string('prix_ht');
            $table->string('tva');
            $table->string('prix_tcc');
            $table->string('description')->nullable();
            $table->integer('reduction')->default(0);
            $table->boolean('disponible')->default(0);
            $table->integer('quantite_predifinis')->nullable();
            $table->integer('durabilite')->nullable();
            $table->integer('idQte')->nullable();
            $table->integer('idIngredient')->nullable();
            $table->integer('idFormat')->nullable();
            $table->integer('idCategorie')->nullable();
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
        Schema::dropIfExists('recettes');
    }
}
