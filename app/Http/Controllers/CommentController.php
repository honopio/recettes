<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Inertia\Inertia;
use App\Models\Recipe;

/**
 *  comments are displayed and created in the view of the recipe they belong to
 */
class CommentController extends Controller
{

    /**
     * display all comments
     */
    function index(){
        $comments = Comment::all(); //get all comments

        return view('recipes/single',array(
            'comments' => $comments
        ));
    }

    /**
     * stores a new comment in the db
     */
    function store(Request $request){
        $request->validate([
            'content' => 'required',
            'recipe_id' => 'required',
            'captcha' => 'required|captcha',
        ]);

        if (!$request->input('captcha')) {
            $recipeback = Recipe::with(['tags', 'user', 'ingredients', 'comments.user'])->where('id', $request->input('recipe_id'))->first();
            return Inertia::render('Single', ['recipe' => $recipeback, 'feedback' => 'Le captcha n\'a pas été validé. Veuillez réessayer.']);
        }

        $comment = new Comment();
        $comment->content = $request->input('content');
        $comment->recipe_id = $request->input('recipe_id');
        $comment->user_id = 1; //hardcoded for now. --------------------- NEEDS TO BE EDITED -------------------------------------
        $comment->save();

        // Get the recipe with the new comment
    $recipe = Recipe::with(['tags', 'user', 'ingredients', 'comments.user'])->where('id', $comment->recipe_id)->first();

    // Return a full page visit with the recipe as a prop
    return Inertia::render('Single', ['recipe' => $recipe, 'feedback' => 'Votre commentaire a bien été posté!']);
    }

}
