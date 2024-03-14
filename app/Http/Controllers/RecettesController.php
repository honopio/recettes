<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RecettesController extends Controller
{
    function index() {
        return view('recettes');
    }

    public function show($recipe_url) {
        $recipe = \App\Models\Recipe::where('url',$recipe_url)->first(); //get first recipe with recipe_nam == $recipe_name

        return view('recipes/single',array( //Pass the recipe to the view
            'recipe' => $recipe
        ));
    }
}
?>
