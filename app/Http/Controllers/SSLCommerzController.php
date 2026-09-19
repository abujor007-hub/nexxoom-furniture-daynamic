<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SSLCommerzController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Initiate SSLCommerz Payment
    |--------------------------------------------------------------------------
    */

    public function pay($id)
    {
        $order = Order::with('items.product')->findOrFail($id);

        
        $transactionId = 'NEXXOOM_' . $order->id . '_' . time();

       
        $order->update([
            'transaction_id' => $transactionId,
            'paymentStatus' => 'pending',
            'paymentMethod' => 'sslcommerz',
        ]);

        /
        $apiUrl = env('SSLCOMMERZ_SANDBOX', true)
            ? 'https://sandbox.sslcommerz.com/gwprocess/v4/api.php'
            : 'https://securepay.sslcommerz.com/gwprocess/v4/api.php';

        $postData = [

           
            'store_id' => env('SSLCOMMERZ_STORE_ID'),
            'store_passwd' => env('SSLCOMMERZ_STORE_PASSWORD'),
            'total_amount' => number_format($order->total, 2, '.', ''),
            'currency' => 'BDT',

            
            'tran_id' => $transactionId,

         
            'success_url' => route('sslcommerz.success'),
            'fail_url' => route('sslcommerz.fail'),
            'cancel_url' => route('sslcommerz.cancel'),
            'ipn_url' => route('sslcommerz.ipn'),

            'cus_name' => $order->fullName,
            'cus_email' => $order->email,
            'cus_add1' => $order->address,
            'cus_city' => 'Dhaka',
            'cus_state' => 'Dhaka',
            'cus_postcode' => '1000',
            'cus_country' => 'Bangladesh',
            'cus_phone' => $order->phone,

            'shipping_method' => 'Courier',
            'ship_name' => $order->fullName,
            'ship_add1' => $order->address,
            'ship_city' => 'Dhaka',
            'ship_state' => 'Dhaka',
            'ship_postcode' => '1000',
            'ship_country' => 'Bangladesh',

        
            'product_name' => 'NexXoom Furniture Order',
            'product_category' => 'Furniture',
            'product_profile' => 'general',

         
            'value_a' => $order->id,
        ];

        try {

            $response = Http::asForm()->post($apiUrl, $postData);

            $data = $response->json();

            if (
                isset($data['GatewayPageURL']) &&
                !empty($data['GatewayPageURL'])
            ) {

                return redirect()->away($data['GatewayPageURL']);
            }

            Log::error('SSLCommerz Payment Initiation Failed', [
                'response' => $data,
            ]);

            return redirect()
                ->route('checkout')
                ->with('error', 'Unable to start SSLCommerz payment.');

        } catch (\Exception $e) {

            Log::error('SSLCommerz Error', [
                'message' => $e->getMessage(),
            ]);

            return redirect()
                ->route('checkout')
                ->with('error', 'Payment gateway connection failed.');
        }
    }




    public function success(Request $request)
    {
        $transactionId = $request->tran_id;

        $order = Order::where(
            'transaction_id',
            $transactionId
        )->first();

        if (!$order) {
            return redirect()
                ->route('checkout')
                ->with('error', 'Order not found.');
        }

        $validationUrl = env('SSLCOMMERZ_SANDBOX', true)
            ? 'https://sandbox.sslcommerz.com/validator/api/validationserverAPI.php'
            : 'https://securepay.sslcommerz.com/validator/api/validationserverAPI.php';

        try {

            $response = Http::get($validationUrl, [
                'val_id' => $request->val_id,
                'store_id' => env('SSLCOMMERZ_STORE_ID'),
                'store_passwd' => env('SSLCOMMERZ_STORE_PASSWORD'),
                'v' => 1,
                'format' => 'json',
            ]);

            $data = $response->json();

     
            if (
                isset($data['status']) &&
                $data['status'] === 'VALID'
            ) {

                // Verify amount
                if (
                    number_format(
                        (float) $data['amount'],
                        2,
                        '.',
                        ''
                    )
                    !==
                    number_format(
                        (float) $order->total,
                        2,
                        '.',
                        ''
                    )
                ) {

                    $order->update([
                        'paymentStatus' => 'failed',
                    ]);

                    return redirect()
                        ->route('order.confirm', $order->id)
                        ->with(
                            'error',
                            'Payment amount verification failed.'
                        );
                }

                $order->update([
                    'paymentStatus' => 'paid',
                ]);

                session()->forget('cart');

                return redirect()
                    ->route('order.confirm', $order->id)
                    ->with(
                        'success',
                        'Payment successful! Your order has been confirmed.'
                    );
            }

        } catch (\Exception $e) {

            Log::error('SSLCommerz Validation Error', [
                'message' => $e->getMessage(),
            ]);
        }

        return redirect()
            ->route('order.confirm', $order->id)
            ->with(
                'error',
                'Payment validation failed.'
            );
    }



    public function fail(Request $request)
    {
        $order = Order::where(
            'transaction_id',
            $request->tran_id
        )->first();

        if ($order) {

            $order->update([
                'paymentStatus' => 'failed',
            ]);

            return redirect()
                ->route('order.confirm', $order->id)
                ->with(
                    'error',
                    'Payment failed. Please try again.'
                );
        }

        return redirect()
            ->route('checkout')
            ->with(
                'error',
                'Payment failed.'
            );
    }




    public function cancel(Request $request)
    {
        $order = Order::where(
            'transaction_id',
            $request->tran_id
        )->first();

        if ($order) {

            $order->update([
                'paymentStatus' => 'cancelled',
            ]);

            return redirect()
                ->route('order.confirm', $order->id)
                ->with(
                    'error',
                    'Payment cancelled.'
                );
        }

        return redirect()
            ->route('checkout')
            ->with(
                'error',
                'Payment cancelled.'
            );
    }



    public function ipn(Request $request)
    {
        Log::info('SSLCommerz IPN', $request->all());

        $order = Order::where(
            'transaction_id',
            $request->tran_id
        )->first();

        if (!$order) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Order not found',
            ]);
        }

        if ($request->status === 'VALID') {

            $order->update([
                'paymentStatus' => 'paid',
            ]);

            return response()->json([
                'status' => 'success',
            ]);
        }

        return response()->json([
            'status' => 'failed',
        ]);
    }
}