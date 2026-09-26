<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\MultipleImage;
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

        // Main image
        'image' => 'required|image|mimes:jpg,jpeg,png,webp',

        // Multiple images
        'multiple_images' => 'nullable',
        
    ]);


    // Main Product
    $data = new product();

    $data->title = $request->title;
    $data->category = $request->category;
    $data->description = $request->description;
    $data->price = $request->price;
    $data->discount_price = $request->discount_price;
    $data->quantity = $request->quantity;
    $data->status = $request->status;

    // Main image save
    $data->image = $request->image->store(
        'products_images',
        'public'
    );

    $data->save();


    // Multiple Images Save
    if ($request->hasFile('multiple_images')) {

        foreach ($request->file('multiple_images') as $image) {

            $imagePath = $image->store(
                'products_images',
                'public'
            );

            MultipleImage::create([
                'product_id' => $data->id,
                'more_image' => $imagePath,
            ]);
        }
    }


    return redirect()
        ->back()
        ->with('success', 'Product added successfully.');
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
  
 $product = product::with('multipleImages')->findOrFail($id);
 
        return view('pages.main.product_details', compact('product'));
    }
public function addToCartStore(Request $request, $id)
{
    $product = Product::findOrFail($id);
 
    $cart  = session()->get('cart', []);
    $stock = (int) $product->quantity;
 
    $quantity = max(1, (int) $request->input('quantity', 1));
 
    // Stock nai
    if ($stock < 1 || $product->status === 'out_of_stock') {
        return redirect()->back()->with('error', 'Sorry, this product is out of stock');
    }
 
    $currentQty = $cart[$product->id]['quantity'] ?? 0;
    $newQty     = $currentQty + $quantity;
    $message    = 'Add to cart successfully';
 
    // Stock er beshi hole stock porjonto rakho
    if ($newQty > $stock) {
        $newQty  = $stock;
        $message = "Only {$stock} items available in stock";
    }
 
    $cart[$product->id] = [
        'id'       => $product->id,
        'name'     => $product->title,
        'quantity' => $newQty,
        'price'    => $product->price,
        'photo'    => $product->image,
    ];
 
    session()->put('cart', $cart);
 
    // BUY NOW
    if ($request->input('action') === 'byenow') {
        return redirect()->route('checkout.page');
    }
 
    // ADD TO CART
    return redirect()->back()->with('success', $message);
}
 
 
// ============================================================
// 2. CART QUANTITY + / - (AJAX)
// ============================================================
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
 
    $product = Product::find($productId);
 
    if (!$product) {
        return response()->json([
            'success' => false,
            'message' => 'Product not found'
        ]);
    }
 
    $stock = (int) $product->quantity;
 
    if ($action === 'inc') {
 
        if ($cart[$productId]['quantity'] + 1 > $stock) {
            return response()->json([
                'success' => false,
                'message' => "Only {$stock} items available in stock"
            ]);
        }
 
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
        'stock'     => $stock,
        'remaining' => $stock - $cart[$productId]['quantity'],
    ]);
}
 
 
// ============================================================
// 3. CART ITEM DELETE
// ============================================================
public function addToCartItemDelete($id)
{
    $cart = session()->get('cart', []);
 
    if (isset($cart[$id])) {
        unset($cart[$id]);
        session()->put('cart', $cart);
    }
 
    return redirect()->back()->with('success', 'product removed from cart successfully');
}
 
 
// ============================================================
// 4. LIVE SEARCH
// ============================================================
public function liveSearch(Request $request)
{
    $search = $request->search;
 
    $products = Product::where('title', 'LIKE', "%{$search}%")
        ->orWhere('category', 'LIKE', "%{$search}%")
        ->limit(8)
        ->get();
 
    return response()->json($products);
}
 
 
// ============================================================
// 5. ORDER PLACE (real stock kombe ekhane)
// ============================================================
// NOTE: Ami tomar order method dekhi nai. Tomar ager order method
// er code ta pathaile ami Order::create() shoho merge kore dibo.
// Ekhon "Order::create" er jayga ta comment e rakhlam.
public function order(Request $request)
{
    $cart = session()->get('cart', []);
 
    if (empty($cart)) {
        return redirect()->back()->with('error', 'Your cart is empty');
    }
 
    try {
        DB::transaction(function () use ($cart, $request) {
 
            foreach ($cart as $item) {
 
                // lockForUpdate: duijon ekshathe last item kinte gele oversell hobe na
                $product = Product::lockForUpdate()->find($item['id']);
 
                if (!$product || $product->quantity < $item['quantity']) {
                    throw new \Exception(
                        ($product->title ?? 'A product') . ' is out of stock or not enough quantity'
                    );
                }
 
                // Real stock komano
                $product->decrement('quantity', $item['quantity']);
            }
 
            // ====== TOMAR ORDER CREATE KORAR CODE EKHANE BOSHAO ======
            // Order::create([...]);
        });
 
    } catch (\Exception $e) {
        return redirect()->back()->with('error', $e->getMessage());
    }
 
    session()->forget('cart');
 
    return redirect()->route('home.page')->with('success', 'Order placed successfully');
}
 
}
