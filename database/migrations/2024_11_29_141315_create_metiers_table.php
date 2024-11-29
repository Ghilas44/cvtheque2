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
        Schema::create('metiers', function (Blueprint $table) {
            $table->id();
            $table->string("libelle", 120)->unique()->comment("Intitulé du métier");
            $table->text("description")->comment("Description du métier");
            $table->string("slug", 120)->comment("slug du métier");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('metiers');
    }
};
