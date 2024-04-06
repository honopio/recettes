<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Inertia\Inertia;

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
            'recipe_id' => 'required'
        ]);

        $comment = new Comment();
        $comment->content = $request->input('content');
        $comment->recipe_id = $request->input('recipe_id');
        $comment->user_id = 1; //hardcoded for now. --------------------- NEEDS TO BE EDITED -------------------------------------
        $comment->save();

        return back();
    }


}
