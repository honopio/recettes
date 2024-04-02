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


function store(Request $request) {
    $validatedData = $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'message' => 'required',
    ]);

    // Create a new Contact record with the validated data
    Contact::create($validatedData);

    // Return a response indicating success
    return Inertia::render('Contact')->with('success', 'Message envoyé avec succès!');
}
}
