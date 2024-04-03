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
        Schema::create('recipes', function (Blueprint $table) {
            $table->id()->onDelete('cascade');

            //foreign key to reference id in users table. nullable
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->mediumText('title');
            $table->longText('content');
            //price of the recipe
            $table->integer('price')->unsigned();
            $table->string('url', 200)->unique('url_UNIQUE');
            $table->string('status', 45)->default('published');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipes');
    }
};
