<?php

namespace App\Http\Controllers;

use App\Models\adds;
use App\Models\product;
use App\Models\link;
use Illuminate\Http\Request;

class pages_conntroller extends Controller
{
    public function home(){
   $data['new_arrival'] = product::where('category', '=', 'New Arrival')
    ->paginate(5);
     $data['Best_Seller']= product::where('category', '=', 'Best Seller')->paginate(5);
     $data['Trandings_Items']= product::where('category', '=', 'Tranding Items')->paginate(5);
     $data['Shop_By_Room']= product::where('category', '=', 'Shop By Room')->paginate(5);
     $data['Our_Favorute_Category']= product::where('category', '=', 'Our Favorute Collection')->take(10)->get();
     $data['Populer_Category']= product::where('category', '=', 'Populer Categories')->paginate(5);
     $data['Sofa']= product::where('category', '=', 'Sofa')->take(4)->get();
     $data['Table']= product::where('category', '=', 'Table')->take(4)->get();
     $data['Chair']= product::where('category', '=', 'Chair')->take(4)->get();
     $data['Bed']= product::where('category', '=', 'Bed')->take(4)->get();
     $data['Light']= product::where('category', '=', 'Light')->take(4)->get();
     $data['slider']= product::where('category', '=', 'slider')->get();
     

     $add= adds::first();

   
   
    
        return view('pages.main.home', compact('data','add'));
    }


    public function newArrivel(){
         $data['new_arrival'] = product::where('category', '=', 'New Arrival')->get();

        return view('pages.main.newArrivel',compact('data'));
    }

    public function shop(){
           $data['new_arrival'] = product::where('category', '=', 'New Arrival')
    ->paginate(5);
     $data['Best_Seller']= product::where('category', '=', 'Best Seller')->paginate(5);
     $data['Trandings_Items']= product::where('category', '=', 'Tranding Items')->paginate(5);
     $data['Shop_By_Room']= product::where('category', '=', 'Shop By Room')->paginate(5);
     $data['Our_Favorute_Category']= product::where('category', '=', 'Our Favorute Collection')->take(10)->get();
     $data['Populer_Category']= product::where('category', '=', 'Populer Categories')->paginate(5);
     $data['Sofa']= product::where('category', '=', 'Sofa')->get();
     $data['Table']= product::where('category', '=', 'Table')->get();
     $data['Chair']= product::where('category', '=', 'Chair')->get();
     $data['Bed']= product::where('category', '=', 'Bed')->get();
     $data['Light']= product::where('category', '=', 'Light')->get();

        return view('pages.main.shop',compact('data'));
    }

    public function bed(){
         $data['Bed']= product::where('category', '=', 'Bed')->take(4)->get();
        return view('pages.main.bed',compact('data'));
    }

    public function sofa(){
            $data['Sofa']= product::where('category', '=', 'Sofa')->get();

        return view('pages.main.sofa',compact('data'));
    }

    public function chair(){
        $data['Chair']= product::where('category', '=', 'Chair')->get();
        return view('pages.main.chair',compact('data'));


    }

    public function contact(){
        $link =Link::first();
        return view('pages.main.contact',compact ('link'));
    }

    public function checkout(){
        $cheackout= session()->get('cart', []);
        return view('pages.main.cheackout',compact('cheackout'));
    }

    public function details(){
   
        return view('pages.main.product_details');
    }




}
