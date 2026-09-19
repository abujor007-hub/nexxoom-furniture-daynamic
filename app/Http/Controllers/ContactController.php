<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
 
public function store(Request $request)
{
    $request->validate([
        'fullName' => 'required|string|max:255',
        'email'    => 'required|email|max:255',
        'phone'    => 'required|string|max:255',
        'address'  => 'required|string|max:255',
        'message'  => 'required|string',
    ]);

    $contact = Contact::updateOrCreate(
        [
            'email' => $request->email,
        ],
        [
            'fullName' => $request->fullName,
            'phone'    => $request->phone,
            'address'  => $request->address,
            'message'  => $request->message,
        ]
    );

    return redirect()->back()->with('success', 'Message submitted successfully!');
}

public function show(){
    $message= Contact::all();
    return view('pages.admin-dashboard.contact.message',compact('message'));
}

}
