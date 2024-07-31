<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tag;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /* ---------- creation de 10 users aleatoires ------------- */
        //first user is the admin
        \App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => 'admin',
        ]);

        \App\Models\User::factory(10)->create();

        /* ---------- creation de 15 recettes aleatoires ------------ */
        \App\Models\Recipe::factory()
            ->count(15)
            ->create()

            //random user from the users table for each recipe
            ->each(function ($recipe) {
                $recipe->user_id = \App\Models\User::inRandomOrder()->first()->id;
                $recipe->save();
            });

        /* ---------- creation de 10 contacts aleatoires ------------- */
        \App\Models\Contact::factory(10)->create();

        /* ---------- creation de 20 commentaires aleatoires ------------- */

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

        /* ---------- creation de 10 tags. hardcodes pour etre realistes ---------- */
        Tag::create(['name' => 'vegan']);
        Tag::create(['name' => 'vegetarien']);
        Tag::create(['name' => 'asiatique']);
        Tag::create(['name' => 'chinois']);
        Tag::create(['name' => 'italien']);
        Tag::create(['name' => 'mexicain']);
        Tag::create(['name' => 'viande']);
        Tag::create(['name' => 'poisson']);
        Tag::create(['name' => 'salade']);
        Tag::create(['name' => 'soupe']);
        Tag::create(['name' => 'entrée']);
        Tag::create(['name' => 'plat']);
        Tag::create(['name' => 'dessert']);

        /* ----------- ajouts de tags a des recettes dans la table de liaison recipe_tag
        fetch toutes les recettes et leur attache entre 0 et 4 tags existants ---------------*/
        \App\Models\Recipe::all()->each(function ($recipe) {
            $tags = Tag::inRandomOrder()->limit(3)->get();
            $recipe->tags()->attach($tags);
        });

        /* ---------- creation de 20 ingredients aleatoires ---------- */
        \App\Models\Ingredient::factory(20)->create();

        /* ----------- ajouts d'ingredients a des recettes dans la table de liaison ingredient_recipe ---------- */
        \App\Models\Recipe::all()->each(function ($recipe) {
            $ingredients = \App\Models\Ingredient::inRandomOrder()->limit(3)->get();
            $recipe->ingredients()->attach($ingredients);
        });



    }
}
