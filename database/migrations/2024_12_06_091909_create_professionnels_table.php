<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('professionnels', function (Blueprint $table) {
            $table->bigIncrements('id')->comment("Identifiant du professionnel");
            $table->timestamps();
            $table->string("prenom", 25)->comment("Prénom du professionnel");
            $table->string("nom", 40)->comment("Nom du professionnel");
            $table->string("cp", 5)->comment("Code postal du professionnel");
            $table->string("ville", 38)->comment("Ville du professionnel");
            $table->string("telephone", 14)->comment("Téléphone du professionnel");
            $table->string('email', 255)->unique()->comment('Email du professionnel');
            $table->date('naissance')->comment('Date de naissance du professionnel');
            $table->boolean("formation")->comment("Professionnel en formation");
            $table->set('domaine', ['S', 'R', 'D'])->comment('Domaine du professionnel');
            $table->string("source", 255)->nullable()->comment("Source profil");
            $table->text("observation")->nullable()->comment("Observation / Commentaire");
            $table->unsignedBigInteger('metier_id');
            $table->foreign('metier_id')
                ->references('id')
                ->on('metiers')
                ->onDelete('restrict')                
                ->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('professionnels');
    }
};
