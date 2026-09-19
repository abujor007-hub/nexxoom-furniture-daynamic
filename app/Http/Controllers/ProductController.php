<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function product()
    {
        $category = Category::all();
        return view('pages.admin-dashboard.product.addProduct', compact('category'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'category' => 'required',
            'description' => 'nullable',
            'price' => 'required|numeric',
            'discount_price' => 'nullable|numeric',
            'quantity' => 'required|integer',
            'status' => 'required',

            'image' => 'required' 
        ]);

        $data = new product();
        $data->title = $request->title;
        $data->category = $request->category;
        $data->description = $request->description;
        $data->price = $request->price;
        $data->discount_price = $request->discount_price;
        $data->quantity = $request->quantity;
        $data->status = $request->status;
        $data->image = $request->image->Store('products_images', 'public');




        $data->save();

        return redirect()->back()->with('success', 'Product added successfully.');
    }

    public function productList()
    {
        $products = product::all();

        return view('pages.admin-dashboard.product.list', compact('products',));
    }

    public function edit($id)
    {
        $product = product::findOrFail($id);
        $category = Category::all();
        return view('pages.admin-dashboard.product.product_edit', compact('product', 'category'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required',
            'category' => 'required',
            'description' => 'nullable',
            'price' => 'required|numeric',
            'discount_price' => 'nullable|numeric',
            'quantity' => 'required|integer',
            'status' => 'required',

       
        ]);

        $data = product::findOrFail($id);
        $data->title = $request->title;
        $data->category = $request->category;
        $data->description = $request->description;
        $data->price = $request->price;
        $data->discount_price = $request->discount_price;
        $data->quantity = $request->quantity;
        $data->status = $request->status;

        if ($request->hasFile('image')) {


            if ($data->image && Storage::disk('public')->exists($data->image)) {
                Storage::disk('public')->delete($data->image);
            }


            $data->image = $request->file('image')->store('products_images', 'public');
        }
        $data->save();

        return redirect()->back()->with('success', 'Product updated successfully.');
    }

    public function destroy($id)
    {
        $product = product::findOrFail($id);
        $product->delete();
        return redirect()->back()->with('success', 'Product deleted successfully.');
    }


    public function sofa()
    {
        $product = product::where('category', 'sofa')->get();
        return view('pages.admin-dashboard.product.sofa', compact('product'));
    }

    public function table()
    {
        $product = product::where('category', 'table')->get();
        return view('pages.admin-dashboard.product.table', compact('product'));
    }

    public function bed()
    {
        $product = product::where('category', 'bed')->get();
        return view('pages.admin-dashboard.product.bed', compact('product'));
    }
        public function slider()
    {
        $product = product::where('category', 'slider')->get();
        return view('pages.admin-dashboard.product.slider', compact('product'));
    }



    public function details($id)
    {
        $product = product::findOrFail($id);
        return view('pages.main.product_details', compact('product'));
    }
 public function addToCartStore(Request $request, $id)
{
    $product = product::findOrFail($id);

    $cart = session()->get('cart', []);

    // Product Details থেকে Quantity নেওয়া
    $quantity = (int) $request->input('quantity', 1);

    if ($quantity < 1) {
        $quantity = 1;
    }


    // Product আগে থেকেই Cart-এ থাকলে
    if (isset($cart[$product->id])) {

        $cart[$product->id]['quantity'] += $quantity;

    } else {

        $cart[$product->id] = [
            'id'       => $product->id,
            'name'     => $product->title,
            'quantity' => $quantity,
            'price'    => $product->price,
            'photo'    => $product->image,
        ];
    }


    // Session Save
    session()->put('cart', $cart);


    // ==============================
    // BUY NOW
    // ==============================

    if ($request->input('action') === 'byenow') {

        return view('pages.main.cheackout');
    }


    // ==============================
    // ADD TO CART
    // ==============================

    return redirect()->back()->with(
        'success',
        'Add to cart successfully'
    );
}
    public function updateQuantity(Request $request)
    {
        $productId = $request->input('product_id');
        $action    = $request->input('action');

        $cart = session()->get('cart', []);

        if (!isset($cart[$productId])) {
            return response()->json([
                'success' => false,
                'message' => 'Item not found in cart'
            ]);
        }

        if ($action === 'inc') {
            $cart[$productId]['quantity'] += 1;
        } elseif ($action === 'dec') {
            $cart[$productId]['quantity'] = max(1, $cart[$productId]['quantity'] - 1);
        }

        session()->put('cart', $cart);

        $cartCount = 0;
        $cartTotal = 0;

        foreach ($cart as $item) {
            $cartCount += $item['quantity'];
            $cartTotal += $item['price'] * $item['quantity'];
        }

        return response()->json([
            'success'   => true,
            'productId' => $productId,
            'quantity'  => $cart[$productId]['quantity'],
            'price'     => $cart[$productId]['price'],
            'itemTotal' => $cart[$productId]['quantity'] * $cart[$productId]['price'],
            'cartTotal' => $cartTotal,
            'cartCount' => $cartCount,
        ]);

     
    }
    public function addToCartItemDelete($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->back()->with('success', 'product removed from cart successfully');
    }


    public function liveSearch(Request $request)
{
    $search = $request->search;

    $products = Product::where('title', 'LIKE', "%{$search}%")
        ->orWhere('category', 'LIKE', "%{$search}%")
        ->limit(8)
        ->get();

    return response()->json($products);
}
}
