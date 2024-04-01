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
    // Get recipes associated with the given tag
    $recipes = Tag::where('name', $tag)->firstOrFail()->recipes;

    // pass the tag information to the view if needed. NOT DONE
    $tagInfo = $tag;


    return view('tags/show', compact('recipes', 'tagInfo'));
    }

}
