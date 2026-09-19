<?php

namespace App\Http\Controllers;

use App\Models\adds;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AddsController extends Controller
{
    public function create(){
        return view('pages.admin-dashboard.add_logo.add_logo');
    }


public function store(Request $request)
{
    $request->validate([
        'addImage' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

  
    $data = adds::first();

    if (!$data) {
        $data = new adds();
    }


    if ($request->hasFile('addImage')) {

        if (
            $data->addImage &&
            Storage::disk('public')->exists($data->addImage)
        ) {
            Storage::disk('public')->delete($data->addImage);
        }

        $data->addImage = $request
            ->file('addImage')
            ->store('add_image', 'public');
    }

  
    if ($request->hasFile('logo')) {

        if (
            $data->logo &&
            Storage::disk('public')->exists($data->logo)
        ) {
            Storage::disk('public')->delete($data->logo);
        }

        $data->logo = $request
            ->file('logo')
            ->store('logo', 'public');
    }

    $data->save();

    return back()->with(
        'success',
        'Image uploaded successfully!'
    );
}
}