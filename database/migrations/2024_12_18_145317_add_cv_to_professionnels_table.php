<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCvToProfessionnelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('professionnels', function (Blueprint $table) {
            // Ajouter une colonne 'cv' de type string (pour un chemin de fichier ou un URL)
            $table->string('cv')->nullable(); // Si vous voulez rendre cette colonne nullable
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('professionnels', function (Blueprint $table) {
            // Supprimer la colonne 'cv'
            $table->dropColumn('cv');
        });
    }
}
