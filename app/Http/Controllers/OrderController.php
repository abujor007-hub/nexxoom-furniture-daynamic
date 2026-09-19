<?php

namespace App\Http\Controllers;

use App\Mail\OrderConfirmedMail;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
public function store(Request $request)
{
    $request->validate([
        'fullName' => 'required',
        'phone' => 'required',
        'email' => 'required|email',
        'address' => 'required',
        'paymentMethod' => 'required|in:cod,bkash,sslcommerz',
    ]);

    $cart = session()->get('cart', []);

    if (empty($cart)) {
        return back()->with('error', 'Cart is empty');
    }

    $subtotal = 0;

    foreach ($cart as $item) {
        $subtotal += $item['price'] * $item['quantity'];
    }

    $shipping = 150;

    $total = $subtotal + $shipping;


    /*
    |--------------------------------------------------------------------------
    | Create Order
    |--------------------------------------------------------------------------
    */

    $order = Order::create([
        'user_id' => Auth::id(),

        'fullName' => $request->fullName,
        'phone' => $request->phone,
        'email' => $request->email,
        'address' => $request->address,

        'message' => $request->message ?? '',

        'subtotal' => $subtotal,
        'shipping' => $shipping,
        'total' => $total,

        'status' => 'pending',

        'paymentMethod' => $request->paymentMethod,
    ]);



    foreach ($cart as $item) {

        $order->items()->create([
            'product_id' => $item['id'],
            'price' => $item['price'],
            'quantity' => $item['quantity'],
        ]);
    }



    session()->forget('cart');




    Mail::to($order->email)->send(
        new OrderConfirmedMail($order)
    );


    if ($request->paymentMethod === 'bkash') {

        return redirect()
            ->route('order.confirm', $order->id)
            ->with(
                'success',
                'Order placed successfully!'
            );
    }




    if ($request->paymentMethod === 'sslcommerz') {

        return redirect()
            ->route(
                'sslcommerz.pay',
                $order->id
            );
    }



    return redirect()
        ->route('order.confirm', $order->id)
        ->with(
            'success',
            'Order placed successfully!'
        );
}

    public function orderConfirm($id)
    {
        $order = Order::with('items.product')
            ->findOrFail($id);

        return view(
            'pages.main.order_confirm',
            compact('order')
        );
    }


     public function index()
    {
        $orders = Order::where('user_id', Auth::id())
            ->with('items.product')
            ->latest()
            ->get();

        return view('user-dashboard.order', compact('orders'));
    }


  
public function show($id)
{
    $order = Order::where('user_id', Auth::id())
        ->with('items.product')
        ->findOrFail($id);

    return view('user-dashboard.order-details', compact('order'));
}




public function edit($id)
{
    $order = Order::where('user_id', Auth::id())
        ->with('items.product')
        ->findOrFail($id);

   
    if (strtolower(trim($order->status)) !== 'pending') {
        return back()->with('error', 'Only pending orders can be edited.');
    }

    return view('user-dashboard.order-edit', compact('order'));
}



    public function update(Request $request, $id)
    {
        $order = Order::where('user_id', Auth::id())
            ->with('items')
            ->findOrFail($id);

        // শুধু Pending order update করা যাবে
        if (strtolower(trim($order->status ?? '')) !== 'pending') {
            return back()->with(
                'error',
                'Only pending orders can be edited.'
            );
        }

      
        $request->validate([
            'fullName' => 'required|string|max:255',
            'phone' => 'required|string|max:30',
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:1000',
            'message' => 'nullable|string|max:1000',

            'quantity' => 'required|array',
            'quantity.*' => 'required|integer|min:1',
        ]);



        $order->update([
            'fullName' => $request->fullName,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'message' => $request->message ?? '',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Update Product Quantities
        |--------------------------------------------------------------------------
        */

        $subtotal = 0;

        foreach ($order->items as $item) {

            if (isset($request->quantity[$item->id])) {

                $newQuantity = (int) $request->quantity[$item->id];

                $item->update([
                    'quantity' => $newQuantity,
                ]);

                $subtotal += $item->price * $newQuantity;
            } else {

                $subtotal += $item->price * $item->quantity;
            }
        }


  

        $shipping = $order->shipping;

        $total = $subtotal + $shipping;


 

        $order->update([
            'subtotal' => $subtotal,
            'total' => $total,
        ]);


        return redirect()
            ->route('orders.page')
            ->with(
                'success',
                'Your order has been updated successfully.'
            );
    }





public function cancel($id)
{
   
    $order = Order::where('user_id', Auth::id())
        ->findOrFail($id);

 
    $status = strtolower(trim((string) $order->status));

    if (!in_array($status, ['pending', 'cancelled'])) {

        return back()->with(
            'error',
            'Only pending or cancelled orders can be deleted.'
        );
    }

  
    $order->delete();

    return redirect()
        ->route('orders.page')
        ->with(
            'success',
            'Order deleted successfully.'
        );
}


public function allorder(){
          $order= Order::with('items.product')->get();

          return view('pages.admin-dashboard.order.allOrder',compact('order'));
}

public function showorder($id)
{
    $order = Order::with('items.product')->findOrFail($id);

    return view(
        'pages.admin-dashboard.order.order_details',
        compact('order')
    );
}

public function updateStatus(Request $request, $id)
{
    $order = Order::findOrFail($id);

    $oldStatus = $order->status;

    $order->status = $request->status;
    $order->save();


    if (
        $request->status === 'delivered' &&
        $oldStatus !== 'delivered'
    ) {
        Mail::to($order->email)->send(
            new OrderConfirmedMail($order)
        );
    }

    return back()->with('success', 'Order status updated successfully.');
}

public function pending(){
    $order= Order::where('status', 'pending')->get();
    return view('pages.admin-dashboard.order.pendig',compact('order'));
}

public function processing(){
    $order = Order::where('status', 'Processing')->get();
    return view('pages.admin-dashboard.order.processing',compact('order'));
}

public function Delivered(){
    $order = Order::where('status', 'Delivered')->get();
    return view('pages.admin-dashboard.order.delivered',compact('order'));
}

public function cancelled(){
    $order = Order::where('status', 'Cancelled')->get();
    return view('pages.admin-dashboard.order.cancelled',compact('order'));
}



}