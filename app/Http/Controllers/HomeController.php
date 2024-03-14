<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;

class HomeController extends Controller
{
    function index(){
        $recipes = Recipe::all(); //get all recipes

        return view('welcome',array(
            'recipes' => $recipes
        ));
    }
}
