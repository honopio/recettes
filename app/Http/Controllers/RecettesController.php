<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use Inertia\Inertia;

class RecettesController extends Controller
{
    /**
     * Afficher toutes les recettes
     */
    function index(){
        // Get all recipes with their associated TAGS, USER, and INGREDIENTS
        $recipes = Recipe::with(['tags', 'user', 'ingredients'])->get();

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
        $recipe = Recipe::where('url',$recipe_url)->first(); //get first recipe with recipe_nam == $recipe_name
        // LOAD CAPTCHA QUESTION ? $captchaQuestion = $this->generateCaptchaQuestion();

        // Fetch tags associated with the recipe
        $tags = $recipe->tags()->pluck('name');

        //methode compact pour passer plusieurs variables à la vue
        return view('recipes/single', compact('recipe', 'tags'));

    }

    /**
     * Chercher des recettes par leur titre, tags ou ingredients
     */
    public function search(Request $request) {
        $search = $request->input('recipe');

        /* si c'est une requete faite aec la search bar,
        on montre les recettes qui contiennent la recherche dans le titre, les tags ou les ingredients */
        if ($search) {

            //search for recipes with the search term in the title
            $recipes = Recipe::where('title', 'like', '%'.$search.'%')->get();

            //add the recipes with the search term in the tags
            $recipes = $recipes->merge(Recipe::whereHas('tags', function($q) use ($search) {
                $q->where('name', 'like', '%'.$search.'%');
            })->get());

            //add the recipes that have the search term in the ingredients
            $recipes = $recipes->merge(Recipe::whereHas('ingredients', function($q) use ($search) {
                $q->where('name', 'like', '%'.$search.'%');
            })->get());

        } else {
            //on retourne les recettes qui ont un ingrédient en particulier dans les ingredients ou dans le titre
            $ingredient = $request->input('ingredient');
            $recipes = Recipe::whereHas('ingredients', function($q) use ($ingredient) {
                $q->where('name', $ingredient);
            })->get();
        }

       //return the recettes view with the recipes
        //return view('recettes', compact('recipes'));

        //NE MARCHE PAS POUR LISNTANT
        return Inertia::render('Recipes', [
            'recipes' => $recipes
        ]);
    }
}
?>
