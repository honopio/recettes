<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

    /**
     * Table de jointure entre recipes et tags
     */
return new class extends Migration
{

    public function up(): void
    {
        Schema::create('recipe_tag', function (Blueprint $table) {
            //no need for an id. On utilise les clés primaires des deux tables
            $table->foreignId('recipe_id')->constrained()->onDelete('cascade');
            $table->foreignId('tag_id')->constrained()->onDelete('cascade');
            $table->unique(['recipe_id', 'tag_id']);

            //no timestamps or any other metadata. if we did add metadata, we would have to create a factory for this table
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipe_tag');
    }
};
