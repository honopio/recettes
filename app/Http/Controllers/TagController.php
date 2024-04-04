<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\Tag;
use Inertia\Inertia;

class TagController extends Controller
{
    public function index()
    {
        // get les tags dans l'ordre alphabétique
        $tags = Tag::orderBy('name')->get();

        return Inertia::render('Tags', [
            'tags' => $tags
        ]);
    }

    public function show($name)
    {
        $recipes = Recipe::whereHas('tags', function ($query) use ($name) {
            $query->where('name', $name);
            })->get();
        return view('tags/show', compact('recipes', 'name'));
    }


    public function searchByTag($tag) {
    // Get recipes associated with the given tag. i need every attribute of the recipes to pass it to the view.
    $recipes = Recipe::whereHas('tags', function ($query) use ($tag) {
        $query->where('name', $tag);
    })->with(['tags', 'user', 'ingredients', 'comments.user'])->get();

    // pass the tag information to the view if needed. NOT DONE
    $tagInfo = $tag;

    //return inertia view
    return Inertia::render('Recipes', [
        'recipes' => $recipes
    ]);

    //when returning a blade view, it somehow doesn't fully reload the page. it does when returning an inertia view
    //return view('tags/show', compact('recipes', 'tagInfo'));
    }

}
