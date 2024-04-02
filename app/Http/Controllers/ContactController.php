<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Inertia\Inertia;

class ContactController extends Controller
{
    function index(){ //loads the contact form template in the view
      //  return view('contact');

      //return Contact.vue
        return Inertia::render('Contact');
    }


    function store(Request $request) { //store the contact form data
    //     $contact = new Contact();
    //   //  $contact->nom = request('nom');
    //     $contact->email = request('email');
    //     $contact->message = request('message');
    //     $contact->save();
    //    return Inertia::render('Contact')->with('success', 'Message envoyé avec succès!'); //return the contact form with a success message
        Contact::create($request->validate([
            'email' => 'required|email',
            'message' => 'required',
        ]));
        return Inertia::render('Contact')->with('success', 'Message envoyé avec succès!'); //return the contact form with a success message
}
}
