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
            'captcha' => 'required|captcha'
        ]);

        // Check if captcha is validated
        if (!$validatedData['captcha']) {
            return redirect()->back()->withErrors(['captcha' => 'Captcha validation failed. Please try again.']);
        }

        // Create a new contact message
        $contact = new Contact();
        $contact->email = $request->input('email');
        $contact->message = $request->input('message');
        $contact->save();

        return redirect()->back();
    }
}
