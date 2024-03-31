<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Table de jointure entre recipes et ingredients
     */
    public function up(): void
    {
        Schema::create('ingredient_recipe', function (Blueprint $table) {
            //pas besoin d'id. On utilise les clés primaires des deux tables
            $table->foreignId('recipe_id')->constrained()->onDelete('cascade');
            $table->foreignId('ingredient_id')->constrained()->onDelete('cascade');
            $table->unique(['recipe_id', 'ingredient_id']);

            //no timestamps or any other metadata. if we did add metadata, we would have to create a factory for this table

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingredient_recipe');
    }
};
