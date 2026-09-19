<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function category(){
       $category= Category::all();
        return view('pages.admin-dashboard.category.category', compact('category'));
    
    }


    public function store(Request $request)
    {
       $validated= $request->validate([
        'category'=> 'required',

    ]);

    $data= new Category();
    $data->category=$request->category;
    $data->save();

     return redirect()->back()->with('success', 'Category added successfully.');
    }

    public function destroy(Request $request,$id){
        $category= Category::find($id);
        $category->delete();
  
        return redirect()->back()->with('success', 'Category deleted successfully');
    }
}