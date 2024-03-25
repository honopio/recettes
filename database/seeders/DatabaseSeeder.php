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

        //creation de 10 tags. hardcodés pour etre plus realistes
        Tag::create(['name' => 'Vegan']);
        Tag::create(['name' => 'Vegetarien']);
        Tag::create(['name' => 'Asiatique']);
        Tag::create(['name' => 'Chinois']);
        Tag::create(['name' => 'Italien']);
        Tag::create(['name' => 'Mexicain']);
        Tag::create(['name' => 'Viande']);
        Tag::create(['name' => 'Poisson']);
        Tag::create(['name' => 'Salade']);
        Tag::create(['name' => 'Soupe']);
        Tag::create(['name' => 'Entrée']);
        Tag::create(['name' => 'Plat']);
        Tag::create(['name' => 'Dessert']);

        //ajouts de tags a des recetes dans la table de liaison recipe_tag

        //fetch toutes les recettes et leur attache entre 0 et 4 tags
        \App\Models\Recipe::all()->each(function ($recipe) {
            $tags = Tag::inRandomOrder()->limit(3)->get();
            $recipe->tags()->attach($tags);
        });



    }
}
