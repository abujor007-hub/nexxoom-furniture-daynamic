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

        /*
        |--------------------------------------------------------------------------
        | Customer Name
        |--------------------------------------------------------------------------
        */

        $customerName = trim(
            $order->first_name . ' ' . $order->last_name
        );

        /*
        |--------------------------------------------------------------------------
        | Transaction ID
        |--------------------------------------------------------------------------
        */

        $transactionId =
            'NEXXOOM_' .
            $order->id .
            '_' .
            time();

        $order->update([
            'transaction_id' => $transactionId,
            'paymentStatus' => 'pending',
            'paymentMethod' => 'sslcommerz',
        ]);

        /*
        |--------------------------------------------------------------------------
        | SSLCommerz URL
        |--------------------------------------------------------------------------
        */

        $apiUrl = env(
            'SSLCOMMERZ_SANDBOX',
            true
        )
            ? 'https://sandbox.sslcommerz.com/gwprocess/v4/api.php'
            : 'https://securepay.sslcommerz.com/gwprocess/v4/api.php';

        /*
        |--------------------------------------------------------------------------
        | Number Of Items
        |--------------------------------------------------------------------------
        */

        $numberOfItems = $order->items->sum('quantity');

        /*
        |--------------------------------------------------------------------------
        | Payment Data
        |--------------------------------------------------------------------------
        */

        $postData = [

            /*
            |--------------------------------------------------------------------------
            | Store Information
            |--------------------------------------------------------------------------
            */

            'store_id' => env(
                'SSLCOMMERZ_STORE_ID'
            ),

            'store_passwd' => env(
                'SSLCOMMERZ_STORE_PASSWORD'
            ),

            /*
            |--------------------------------------------------------------------------
            | Payment Information
            |--------------------------------------------------------------------------
            */

            'total_amount' => number_format(
                (float) $order->total,
                2,
                '.',
                ''
            ),

            'currency' => 'BDT',

            'tran_id' => $transactionId,

            /*
            |--------------------------------------------------------------------------
            | Callback URLs
            |--------------------------------------------------------------------------
            */

            'success_url' => route(
                'sslcommerz.success'
            ),

            'fail_url' => route(
                'sslcommerz.fail'
            ),

            'cancel_url' => route(
                'sslcommerz.cancel'
            ),

            'ipn_url' => route(
                'sslcommerz.ipn'
            ),

            /*
            |--------------------------------------------------------------------------
            | Customer Information
            |--------------------------------------------------------------------------
            */

            'cus_name' => $customerName,

            'cus_email' => $order->email,

            'cus_add1' => $order->address,

            'cus_city' => $order->city ?: 'Dhaka',

            'cus_state' => $order->distirct ?: 'Dhaka',

            'cus_postcode' => $order->post_code ?: '1000',

            'cus_country' => $order->country ?: 'Bangladesh',

            'cus_phone' => $order->phone,

            /*
            |--------------------------------------------------------------------------
            | Shipping Information
            |--------------------------------------------------------------------------
            */

            'shipping_method' => 'Courier',

            'num_of_item' => $numberOfItems,

            'ship_name' => $customerName,

            'ship_add1' => $order->address,

            'ship_city' => $order->city ?: 'Dhaka',

            'ship_state' => $order->distirct ?: 'Dhaka',

            'ship_postcode' => $order->post_code ?: '1000',

            'ship_country' => $order->country ?: 'Bangladesh',

            /*
            |--------------------------------------------------------------------------
            | Product Information
            |--------------------------------------------------------------------------
            */

            'product_name' =>
                'NexXoom Furniture Order',

            'product_category' =>
                'Furniture',

            'product_profile' =>
                'physical-goods',

            /*
            |--------------------------------------------------------------------------
            | Custom Value
            |--------------------------------------------------------------------------
            */

            'value_a' => $order->id,
        ];

        /*
        |--------------------------------------------------------------------------
        | Log Request Data
        |--------------------------------------------------------------------------
        */

        Log::info(
            'SSLCommerz Payment Request',
            [
                'order_id' => $order->id,
                'transaction_id' => $transactionId,
                'postData' => $postData,
            ]
        );

        try {

            /*
            |--------------------------------------------------------------------------
            | Send Request
            |--------------------------------------------------------------------------
            */

            $response = Http::asForm()
                ->timeout(30)
                ->post(
                    $apiUrl,
                    $postData
                );

            $data = $response->json();

            /*
            |--------------------------------------------------------------------------
            | Log SSLCommerz Response
            |--------------------------------------------------------------------------
            */

            Log::info(
                'SSLCommerz Payment Response',
                [
                    'status_code' =>
                        $response->status(),

                    'response' => $data,
                ]
            );

            /*
            |--------------------------------------------------------------------------
            | Redirect To Gateway
            |--------------------------------------------------------------------------
            */

            if (
                isset($data['GatewayPageURL']) &&
                !empty($data['GatewayPageURL'])
            ) {

                return redirect()->away(
                    $data['GatewayPageURL']
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Gateway Error
            |--------------------------------------------------------------------------
            */

            Log::error(
                'SSLCommerz Payment Initiation Failed',
                [
                    'status_code' =>
                        $response->status(),

                    'response' => $data,
                ]
            );

            $errorMessage =
                $data['failedreason']
                ?? $data['error_reason']
                ?? $data['message']
                ?? 'Unable to start SSLCommerz payment.';

            return redirect()
                ->route('checkout.page')
                ->with(
                    'error',
                    $errorMessage
                );

        } catch (\Exception $e) {

            Log::error(
                'SSLCommerz Error',
                [
                    'message' =>
                        $e->getMessage(),

                    'line' =>
                        $e->getLine(),

                    'file' =>
                        $e->getFile(),
                ]
            );

            return redirect()
                ->route('checkout.page')
                ->with(
                    'error',
                    'Payment gateway connection failed.'
                );
        }
    }


    /*
    |--------------------------------------------------------------------------
    | Success
    |--------------------------------------------------------------------------
    */

    public function success(
        Request $request
    ) {

        Log::info(
            'SSLCommerz Success Callback',
            $request->all()
        );

        $transactionId =
            $request->tran_id;

        $order = Order::where(
            'transaction_id',
            $transactionId
        )->first();

        if (!$order) {

            return redirect()
                ->route('checkout.page')
                ->with(
                    'error',
                    'Order not found.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Validation URL
        |--------------------------------------------------------------------------
        */

        $validationUrl = env(
            'SSLCOMMERZ_SANDBOX',
            true
        )
            ? 'https://sandbox.sslcommerz.com/validator/api/validationserverAPI.php'
            : 'https://securepay.sslcommerz.com/validator/api/validationserverAPI.php';

        try {

            /*
            |--------------------------------------------------------------------------
            | Validate Transaction
            |--------------------------------------------------------------------------
            */

            $response = Http::timeout(30)
                ->get(
                    $validationUrl,
                    [
                        'val_id' =>
                            $request->val_id,

                        'store_id' =>
                            env('SSLCOMMERZ_STORE_ID'),

                        'store_passwd' =>
                            env('SSLCOMMERZ_STORE_PASSWORD'),

                        'v' => 1,

                        'format' => 'json',
                    ]
                );

            $data = $response->json();

            /*
            |--------------------------------------------------------------------------
            | Log Validation Response
            |--------------------------------------------------------------------------
            */

            Log::info(
                'SSLCommerz Validation Response',
                [
                    'response' => $data,
                ]
            );

            /*
            |--------------------------------------------------------------------------
            | Check Status
            |--------------------------------------------------------------------------
            */

            if (
                isset($data['status']) &&
                $data['status'] === 'VALID'
            ) {

                /*
                |--------------------------------------------------------------------------
                | Verify Transaction ID
                |--------------------------------------------------------------------------
                */

                if (
                    isset($data['tran_id']) &&
                    $data['tran_id'] !==
                    $order->transaction_id
                ) {

                    $order->update([
                        'paymentStatus' =>
                            'failed',
                    ]);

                    return redirect()
                        ->route(
                            'order.confirm',
                            $order->id
                        )
                        ->with(
                            'error',
                            'Transaction verification failed.'
                        );
                }

                /*
                |--------------------------------------------------------------------------
                | Verify Amount
                |--------------------------------------------------------------------------
                */

                $gatewayAmount =
                    number_format(
                        (float) ($data['amount'] ?? 0),
                        2,
                        '.',
                        ''
                    );

                $orderAmount =
                    number_format(
                        (float) $order->total,
                        2,
                        '.',
                        ''
                    );

                if (
                    $gatewayAmount !==
                    $orderAmount
                ) {

                    $order->update([
                        'paymentStatus' =>
                            'failed',
                    ]);

                    return redirect()
                        ->route(
                            'order.confirm',
                            $order->id
                        )
                        ->with(
                            'error',
                            'Payment amount verification failed.'
                        );
                }

                /*
                |--------------------------------------------------------------------------
                | Payment Success
                |--------------------------------------------------------------------------
                */

                $order->update([
                    'paymentStatus' =>
                        'paid',
                ]);

                /*
                |--------------------------------------------------------------------------
                | Clear Cart
                |--------------------------------------------------------------------------
                */

                session()->forget('cart');

                return redirect()
                    ->route(
                        'order.confirm',
                        $order->id
                    )
                    ->with(
                        'success',
                        'Payment successful! Your order has been confirmed.'
                    );
            }

        } catch (\Exception $e) {

            Log::error(
                'SSLCommerz Validation Error',
                [
                    'message' =>
                        $e->getMessage(),

                    'line' =>
                        $e->getLine(),
                ]
            );
        }

        return redirect()
            ->route(
                'order.confirm',
                $order->id
            )
            ->with(
                'error',
                'Payment validation failed.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Failed Payment
    |--------------------------------------------------------------------------
    */

    public function fail(
        Request $request
    ) {

        Log::warning(
            'SSLCommerz Payment Failed',
            [
                'request' =>
                    $request->all(),
            ]
        );

        $order = Order::where(
            'transaction_id',
            $request->tran_id
        )->first();

        if ($order) {

            $order->update([
                'paymentStatus' =>
                    'failed',
            ]);

            return redirect()
                ->route(
                    'order.confirm',
                    $order->id
                )
                ->with(
                    'error',
                    'Payment failed. Please try again.'
                );
        }

        return redirect()
            ->route('checkout.page')
            ->with(
                'error',
                'Payment failed. Order could not be found.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Cancel Payment
    |--------------------------------------------------------------------------
    */

    public function cancel(
        Request $request
    ) {

        Log::warning(
            'SSLCommerz Payment Cancelled',
            [
                'request' =>
                    $request->all(),
            ]
        );

        $order = Order::where(
            'transaction_id',
            $request->tran_id
        )->first();

        if ($order) {

            $order->update([
                'paymentStatus' =>
                    'cancelled',
            ]);

            return redirect()
                ->route(
                    'order.confirm',
                    $order->id
                )
                ->with(
                    'error',
                    'Payment cancelled.'
                );
        }

        return redirect()
            ->route('checkout.page')
            ->with(
                'error',
                'Payment cancelled.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | IPN
    |--------------------------------------------------------------------------
    */

    public function ipn(
        Request $request
    ) {

        Log::info(
            'SSLCommerz IPN',
            $request->all()
        );

        $order = Order::where(
            'transaction_id',
            $request->tran_id
        )->first();

        if (!$order) {

            return response()->json([
                'status' =>
                    'failed',

                'message' =>
                    'Order not found',
            ]);
        }

        if (
            $request->status === 'VALID'
        ) {

            $order->update([
                'paymentStatus' =>
                    'paid',
            ]);

            return response()->json([
                'status' =>
                    'success',
            ]);
        }

        return response()->json([
            'status' =>
                'failed',
        ]);
    }
}