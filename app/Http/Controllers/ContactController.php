<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Inertia\Inertia;

class ContactController extends Controller
{
    /**
     * loads the contact form template in the view
     */
    function index() {
      //return Contact.vue
    //  print_r(Inertia::render('Contact')); die;
      return Inertia::render('Contact');

    }


    function store(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        // Create a new contact message
        $contact = new Contact();
        // $contact->name = $request->input('name');
        $contact->email = $request->input('email');
        $contact->message = $request->input('message');
        $contact->save();

        return redirect()->back();

        // Return a response indicating success
        //return Inertia::render('Contact')->with('success', 'Message envoyé avec succès!');
    }
}
