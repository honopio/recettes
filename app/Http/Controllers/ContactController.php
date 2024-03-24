<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    function index(){
        return view('contact');
    }
    //ajout de la fonction store pour le formulaire de contact
    /*function store(Request $request){
        $request->validate([
            'nom' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);
        return back()->with('message', 'Votre message a bien été envoyé.');
    }*/

    function store() {
        $contact = new Contact();
      //  $contact->nom = request('nom');
        $contact->email = request('email');
        $contact->message = request('message');
        $contact->save();
        return back()->with('success', 'Votre message a bien été envoyé.');
}
}
