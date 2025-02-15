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
        Schema::create('competences', function (Blueprint $table) {
            $table->id()->comment("Identifiant de la compétence");
            $table->string("intitule", 120)->comment("Intitulé de la compétence");
            $table->text("description")->comment("Description de la compétence");
            $table->timestamps(); // 2 rubriques -> created_at && updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('competences');
    }
};
