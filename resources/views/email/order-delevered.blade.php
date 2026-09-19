<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Order Delivered</title>
</head>

<body style="font-family: Arial, sans-serif; background:#f5f5f5; padding:30px;">

    <div style="max-width:600px; margin:auto; background:#ffffff; padding:30px; border-radius:10px;">

        <h2 style="color:#198754;">
            Order Delivered 🎉
        </h2>

        <p>
            Dear {{ $order->fullName }},
        </p>

        <p>
            Possible আপনার order টি successfully delivered হয়েছে।
        </p>

        <p>
            <strong>Order ID:</strong> #{{ $order->id }}
        </p>

        <p>
            <strong>Total Amount:</strong> ৳{{ number_format($order->total, 2) }}
        </p>

        <p>
            Thank you for shopping with <strong>NexXoom Furniture</strong>.
        </p>

        <p>
            We hope you enjoy your purchase ❤️
        </p>

        <hr>

        <p style="color:#777;">
            If you have any questions about your order, please contact us.
        </p>

    </div>

</body>
</html>