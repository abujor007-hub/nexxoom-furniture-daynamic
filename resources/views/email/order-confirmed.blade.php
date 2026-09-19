<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">

    <title>Order Confirmed</title>
</head>

<body>

    <h2>Thank You for Your Order!</h2>

    <p>
        Hello {{ $order->fullName }},
    </p>

    <p>
        Your order has been successfully confirmed.
    </p>

    <hr>

    <p>
        <strong>Order ID:</strong>
        #{{ $order->id }}
    </p>

    <p>
        <strong>Phone:</strong>
        {{ $order->phone }}
    </p>

    <p>
        <strong>Email:</strong>
        {{ $order->email }}
    </p>

    <p>
        <strong>Address:</strong>
        {{ $order->address }}
    </p>

    <p>
        <strong>Subtotal:</strong>
        ৳{{ number_format($order->subtotal, 2) }}
    </p>

    <p>
        <strong>Shipping:</strong>
        ৳{{ number_format($order->shipping, 2) }}
    </p>

    <p>
        <strong>Total:</strong>
        ৳{{ number_format($order->total, 2) }}
    </p>

    <hr>

    <p>
        We have received your order and will process it shortly.
    </p>

    <p>
        Thank you for shopping with NexXoom Furniture.
    </p>

</body>

</html>