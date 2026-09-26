<?php

namespace App\Http\Controllers;

use App\Mail\OrderConfirmedMail;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Validate Checkout Form
        |--------------------------------------------------------------------------
        */

        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'address' => 'required',

            'paymentMethod' => 'required|in:cod,bkash,sslcommerz',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Get Cart
        |--------------------------------------------------------------------------
        */

        $cart = session()->get('cart', []);

        if (empty($cart)) {

            return back()
                ->withInput()
                ->with('error', 'Cart is empty');
        }

        /*
        |--------------------------------------------------------------------------
        | Calculate Subtotal
        |--------------------------------------------------------------------------
        */

        $subtotal = 0;

        foreach ($cart as $item) {

            $subtotal += $item['price'] * $item['quantity'];
        }

        /*
        |--------------------------------------------------------------------------
        | Shipping
        |--------------------------------------------------------------------------
        */

        if ($request->district === 'Dhaka') {

            $shipping = 80;
        } else {

            $shipping = 150;
        }

        /*
        |--------------------------------------------------------------------------
        | Total
        |--------------------------------------------------------------------------
        */

        $total = $subtotal + $shipping;

        /*
        |--------------------------------------------------------------------------
        | Create Order + Update Stock
        |--------------------------------------------------------------------------
        */

        try {

            $order = DB::transaction(function () use (
                $request,
                $cart,
                $subtotal,
                $shipping,
                $total
            ) {

                /*
                |--------------------------------------------------------------------------
                | Create Order
                |--------------------------------------------------------------------------
                */

                $order = Order::create([
                    'user_id' => Auth::id(),

                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,

                    'phone' => $request->phone,
                    'email' => $request->email,

                    'address' => $request->address,

                    'message' => $request->message ?? '',

                    'subtotal' => $subtotal,
                    'shipping' => $shipping,
                    'total' => $total,

                    'status' => 'pending',

                    'paymentMethod' => $request->paymentMethod,

                    'country' => $request->country,

                    'city' => $request->city,
                    'distirct' => $request->distirct,

                    'post_code' => $request->post_code,
                ]);

                /*
                |--------------------------------------------------------------------------
                | Order Items + Stock
                |--------------------------------------------------------------------------
                */

                foreach ($cart as $item) {

                    /*
                    |--------------------------------------------------------------------------
                    | Lock Product
                    |--------------------------------------------------------------------------
                    */

                    $product = Product::lockForUpdate()
                        ->find($item['id']);

                    /*
                    |--------------------------------------------------------------------------
                    | Product Not Found
                    |--------------------------------------------------------------------------
                    */

                    if (! $product) {

                        throw new \Exception(
                            'Product not found.'
                        );
                    }

                    /*
                    |--------------------------------------------------------------------------
                    | Check Available Stock
                    |--------------------------------------------------------------------------
                    */

                    if ($product->quantity < $item['quantity']) {

                        throw new \Exception(
                            ($product->title ?? 'A product')
                                . ' is out of stock or not enough quantity'

                        );
                    }

                    /*
                    |--------------------------------------------------------------------------
                    | Create Order Item
                    |--------------------------------------------------------------------------
                    */

                    $order->items()->create([

                        'product_id' => $item['id'],

                        'price' => $item['price'],

                        'quantity' => $item['quantity'],

                    ]);

                    /*
                    |--------------------------------------------------------------------------
                    | Decrease Product Stock
                    |--------------------------------------------------------------------------
                    |
                    | Example:
                    |
                    | Database Stock = 100
                    | Customer Orders = 4
                    | Remaining Stock = 96
                    |
                    */

                    $product->decrement(
                        'quantity',
                        $item['quantity']
                    );

                    /*
                    |--------------------------------------------------------------------------
                    | Automatically Set Out Of Stock
                    |--------------------------------------------------------------------------
                    */

                    if ($product->fresh()->quantity <= 0) {

                        $product->update([
                            'status' => 'out_of_stock',
                        ]);
                    }
                }

                return $order;
            });
        } catch (\Exception $e) {

            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }

        /*
        |--------------------------------------------------------------------------
        | Clear Cart
        |--------------------------------------------------------------------------
        */

        session()->forget('cart');

        /*
        |--------------------------------------------------------------------------
        | Send Order Confirmation Email
        |--------------------------------------------------------------------------
        */

        try {

            Mail::to($order->email)->send(
                new OrderConfirmedMail($order)
            );
        } catch (\Exception $e) {

            report($e);
        }

        /*
        |--------------------------------------------------------------------------
        | bKash
        |--------------------------------------------------------------------------
        */

        if ($request->paymentMethod === 'bkash') {

            return redirect()
                ->route(
                    'order.confirm',
                    $order->id
                )
                ->with(
                    'success',
                    'Order placed successfully!'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | SSLCommerz
        |--------------------------------------------------------------------------
        */

        if ($request->paymentMethod === 'sslcommerz') {

            return redirect()
                ->route(
                    'sslcommerz.pay',
                    $order->id
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Cash On Delivery
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'order.confirm',
                $order->id
            )
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

        if (! in_array($status, ['pending', 'cancelled'])) {

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

    public function allorder()
    {
        $order = Order::with('items.product')->get();

        return view('pages.admin-dashboard.order.allOrder', compact('order'));
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

    public function pending()
    {
        $order = Order::where('status', 'pending')->get();

        return view('pages.admin-dashboard.order.pendig', compact('order'));
    }

    public function processing()
    {
        $order = Order::where('status', 'Processing')->get();

        return view('pages.admin-dashboard.order.processing', compact('order'));
    }

    public function Delivered()
    {
        $order = Order::where('status', 'Delivered')->get();

        return view('pages.admin-dashboard.order.delivered', compact('order'));
    }

    public function cancelled()
    {
        $order = Order::where('status', 'Cancelled')->get();

        return view('pages.admin-dashboard.order.cancelled', compact('order'));
    }
}
