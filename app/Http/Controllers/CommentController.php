<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    //implement crud. comments are displayed in the view of the recipe they belong to : recipes/single.blade.php
    //comments are created in the view of the recipe they belong to : recipes/single.blade.php

    //function to display all comments
    function index(){
        $comments = Comment::all(); //get all comments

        return view('recipes/single',array(
            'comments' => $comments
        ));
    }

    //function to create a comment
    function store() {
        $comment = new Comment();
        $comment->content = request('content');
        $comment->recipe_id = request('recipe_id');
        $comment->user_id = 1; //hardcoded for now. --------------------- NEEDS TO BE EDITED -------------------------------------
        $comment->save();

        return back()->with('success', 'Votre commentaire a bien été ajouté.');
    }


}
