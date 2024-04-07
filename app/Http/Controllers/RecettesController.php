<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use Inertia\Inertia;
use Illuminate\Support\Facades\Log;

class RecettesController extends Controller
{
    /**
     * Afficher toutes les recettes
     */
    function index(){
        // Get all recipes with their associated TAGS, USER, and INGREDIENTS
        $recipes = Recipe::with(['tags', 'user', 'ingredients', 'comments', 'comments.user'])->get();

        // Return Recipes.vue with all the recipes
        //return($recipes);
        return Inertia::render('Recipes', [
            'recipes' => $recipes
        ]);
    }

    /**
     * Montrer une seule recette, en entier, avec les commentaires
     */
    public function show($recipe_url) {
        //get recipe with tags, user, ingredients, where url = $recipe_url
        $recipe = Recipe::with(['tags', 'user', 'ingredients', 'comments.user'])->where('url', $recipe_url)->first();

        // Fetch tags associated with the recipe
        // $tags = $recipe->tags()->pluck('name');
        Log::info('Comments data structure:', $recipe->comments->toArray());


        return Inertia::render('Single', [
            'recipe' => $recipe
        ]);

    }

    /**
     * Chercher des recettes par leur titre, tags et/ou ingredients
     */
    public function search(Request $request) {
        $search = $request->input('recipe');

        /* si c'est une requete faite aec la search bar,
        on montre les recettes qui contiennent la recherche dans le titre, les tags ou les ingredients */
        if ($search) {

            //search for recipes with the search term in the title. with tags, user, ingredients, and comments
            $recipes = Recipe::with(['tags', 'user', 'ingredients', 'comments', 'comments.user'])
            ->where('title', 'like', '%'.$search.'%')
            ->get();

            //add the recipes with the search term in the tags
            $recipes = $recipes->merge(Recipe::whereHas('tags', function($q) use ($search) {
                $q->where('name', 'like', '%'.$search.'%');
            })->with(['user', 'tags', 'ingredients', 'comments', 'comments.user'])->get());

            //add the recipes that have the search term in the ingredients
            $recipes = $recipes->merge(Recipe::whereHas('ingredients', function($q) use ($search) {
                $q->where('name', 'like', '%'.$search.'%');
            })->with(['user', 'tags', 'ingredients', 'comments', 'comments.user'])->get());

        } else {
            //on retourne les recettes qui ont un ingrédient en particulier dans les ingredients ou dans le titre
            $ingredient = $request->input('ingredient');
            $recipes = Recipe::whereHas('ingredients', function($q) use ($ingredient) {
                $q->where('name', $ingredient);
            })->with(['user', 'tags', 'ingredients'])->get();
        }

        return Inertia::render('Recipes', [
            'recipes' => $recipes
        ]);
    }
}
?>
