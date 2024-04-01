<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use Inertia\Inertia;

class RecettesController extends Controller
{
    function index(){
        // Get all recipes with their associated TAGS, USER, and INGREDIENTS
        $recipes = Recipe::with(['tags', 'user', 'ingredients'])->get();

        // Return Recipes.vue with all the recipes
        //return($recipes);
        return Inertia::render('Recipes', [
            'recipes' => $recipes
        ]);
    }

    public function show($recipe_url) {
        $recipe = Recipe::where('url',$recipe_url)->first(); //get first recipe with recipe_nam == $recipe_name
        // LOAD CAPTCHA QUESTION ? $captchaQuestion = $this->generateCaptchaQuestion();

        // Fetch tags associated with the recipe
        $tags = $recipe->tags()->pluck('name');

        //methode compact pour passer plusieurs variables à la vue
        return view('recipes/single', compact('recipe', 'tags'));

    }

    public function search(Request $request) {
        $search = $request->input('recipe');

        //search for recipes with the search term in the title or in the tags
        $recipes = Recipe::where('title', 'like', '%'.$search.'%')->get();

        //add the recipes with the search term in the tags
        $recipes = $recipes->merge(Recipe::whereHas('tags', function($q) use ($search) {
            $q->where('name', 'like', '%'.$search.'%');
        })->get());

       //return the recettes view with the recipes
         return view('recettes', compact('recipes'));
    }
}
?>
