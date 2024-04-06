<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Inertia\Inertia;

class ContactController extends Controller
{
    /**
     * montre le formulaire de contact
     */
    function index() {
      //return Contact.vue
    //  print_r(Inertia::render('Contact')); die;
      return Inertia::render('Contact');

    }

/**
 * stores a new contact message in the db
 */
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

    }
}
