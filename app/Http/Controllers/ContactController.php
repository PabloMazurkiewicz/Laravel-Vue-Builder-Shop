<?php

namespace App\Http\Controllers;

use App\Models\ContactFormMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('admin.contacts.index', [
            'contacts' => ContactFormMessage::paginate()
        ]);
    }

    public function edit(ContactFormMessage $contact_form_message)
    {
        return view('admin.contacts.show', [
            'message' => $contact_form_message
        ]);
    }

    public function show()
    {
        return view('contact-us');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required|min:20'
        ]);

        ContactFormMessage::create( $validated );

        return back()->with('success', 'Your message was successfully sent');
    }

    public function destroy(ContactFormMessage $contact_form_message)
    {
        $contact_form_message->delete();

        return redirect()->route('admin.contacts.index');
    }

}
