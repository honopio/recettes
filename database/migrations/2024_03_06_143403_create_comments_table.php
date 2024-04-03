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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();

            //foreign key to reference id in users table. user_id is nullable
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            //foreign key to reference id in recipes table. if recipe is deleted, comments are deleted too
            $table->foreignId('recipe_id')->constrained()->onDelete('cascade');

            $table->longText('content');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
