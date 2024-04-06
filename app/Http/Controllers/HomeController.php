<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use Inertia\Inertia;

class HomeController extends Controller
{
    /**
     * page d'accueil qui display les 3 recettes les + recentes
     */
    function index(){
    //get 3 most recent recipes
    $recipes = Recipe::with(['tags', 'user', 'ingredients'])
                    ->latest()
                    ->limit(3)
                    ->get();

    //return Welcome.vue
    return Inertia::render('Welcome', [
        'recipes' => $recipes
    ]);
    }
}
