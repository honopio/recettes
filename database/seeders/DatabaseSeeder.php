<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //creation de 10 users aleatoires
        \App\Models\User::factory(10)->create();

        //creation d'un user unique
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        //creation de 15 recettes aleatoires
        \App\Models\Recipe::factory()
            ->count(15)
            ->create()

            //random user from the users table for each recipe
            ->each(function ($recipe) {
                $recipe->user_id = \App\Models\User::inRandomOrder()->first()->id;
                $recipe->save();
            });

        // Creation de 10 contacts aleatoires
        \App\Models\Contact::factory(10)->create();

        // create 20 comments
        \App\Models\Comment::factory(20)->create()

            //random user from the users table for each comment
            ->each(function ($comment) {
                $comment->user_id = \App\Models\User::inRandomOrder()->first()->id;
                $comment->save();
            })

            //random recipe from the recipes table for each comment
            ->each(function ($comment) {
                $comment->recipe_id = \App\Models\Recipe::inRandomOrder()->first()->id;
                $comment->save();
            });
    }
}
