<?php

namespace App\Http\Controllers;

use App\Models\link;
use Illuminate\Http\Request;



class LinkController extends Controller
{
    public function create(){
        return view('pages.admin-dashboard.sociallink.social');
    }


public function store(Request $request)
{
    $validated = $request->validate([

        'facebook' => 'nullable|url',
        'youtube' => 'nullable|url',
        'twitter' => 'nullable|url',
        'webSite' => 'nullable|url',
        'github' => 'nullable|url',
        'whatsApp' => 'nullable',
        'linkedin' => 'nullable|url',
        'gmail' => 'nullable|email',

    ]);


    $data = Link::first();

    if (!$data) {
        $data = new Link();
    }

  
    foreach ($validated as $key => $value) {

        if (!is_null($value) && $value !== '') {
            $data->$key = $value;
        }

    }

    $data->save();

    return back()->with(
        'success',
        'Social links updated successfully!'
    );
}
}
