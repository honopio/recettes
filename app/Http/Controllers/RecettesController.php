<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;

class RecettesController extends Controller
{
    function index(){
       /* $recipes = Recipe::all(); //get all recipes

        return view('recettes',array(
            'recipes' => $recipes*/

        // Get all recipes with their associated tags
        $recipes = Recipe::with('tags')->get();

        //methode compact pour passer plusieurs variables à la vue
        return view('recettes', compact('recipes'));
    }

    public function show($recipe_url) {
        $recipe = Recipe::where('url',$recipe_url)->first(); //get first recipe with recipe_nam == $recipe_name
        // LOAD CAPTCHA QUESTION ? $captchaQuestion = $this->generateCaptchaQuestion();

        // Fetch tags associated with the recipe
        $tags = $recipe->tags()->pluck('name');

        //methode compact pour passer plusieurs variables à la vue
        return view('recipes/single', compact('recipe', 'tags'));

    }
}
?>
