<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use Inertia\Inertia;

class HomeController extends Controller
{
    function index(){
    //get first 3 recipes
    $recipes = Recipe::with(['tags', 'user', 'ingredients'])->limit(3)->get();

    //return Welcome.vue
    return Inertia::render('Welcome', [
        'recipes' => $recipes
    ]);
    }
}
