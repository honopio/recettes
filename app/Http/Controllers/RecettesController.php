<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;

class RecettesController extends Controller
{
    function index(){
        $recipes = Recipe::all(); //get all recipes

        return view('recettes',array(
            'recipes' => $recipes
        ));}

    public function show($recipe_url) {
        $recipe = \App\Models\Recipe::where('url',$recipe_url)->first(); //get first recipe with recipe_nam == $recipe_name
        // LOAD CAPTCHA QUESTION ? $captchaQuestion = $this->generateCaptchaQuestion();
        return view('recipes/single',array( //Pass the recipe to the view
            'recipe' => $recipe
        ));
    }
}
?>
