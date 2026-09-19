
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Order Confirmed - NexXoom</title>


    <!-- Bootstrap CSS -->

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
        rel="stylesheet">


    <!-- Bootstrap Icons -->

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
        rel="stylesheet">

</head>


<body class="bg-light">


    <div class="container py-4 py-md-5">


        <!-- =================================
             WELCOME / SUCCESS
        ================================== -->

        <div class="text-center mb-4">


            <div
                class="d-inline-flex align-items-center justify-content-center bg-success-subtle text-success rounded-circle p-4 mb-3">

                <i class="bi bi-check-lg display-5"></i>

            </div>


            <h2 class="fw-bold">

                Order Confirmed!

            </h2>


            <p class="text-secondary mb-2">

                Thank you for your order,
                <strong>{{ $order->fullName }}</strong>.

            </p>


            <p class="text-secondary">

                Your order has been successfully placed.

            </p>


            <span class="badge text-bg-dark px-3 py-2">

                Order #{{ $order->id }}

            </span>


        </div>



        <!-- =================================
             CUSTOMER + COMPANY INFORMATION
        ================================== -->

        <div class="row g-4 mb-4">


            <!-- CUSTOMER INFORMATION -->

            <div class="col-lg-6">

                <div class="card border-0 shadow-sm h-100">

                    <div class="card-body p-4">


                        <h5 class="fw-bold border-bottom pb-3 mb-4">

                            <i class="bi bi-person-circle me-2"></i>

                            Customer Information

                        </h5>


                        <!-- Full Name -->

                        <div class="mb-3">

                            <small class="text-secondary d-block">

                                Full Name

                            </small>

                            <span class="fw-medium">

                                {{ $order->fullName }}

                            </span>

                        </div>


                        <!-- Phone -->

                        <div class="mb-3">

                            <small class="text-secondary d-block">

                                Phone

                            </small>

                            <span class="fw-medium">

                                {{ $order->phone }}

                            </span>

                        </div>


                        <!-- Email -->

                        <div class="mb-3">

                            <small class="text-secondary d-block">

                                Email

                            </small>

                            <span class="fw-medium">

                                {{ $order->email }}

                            </span>

                        </div>


                        <!-- Address -->

                        <div>

                            <small class="text-secondary d-block">

                                Delivery Address

                            </small>

                            <span class="fw-medium">

                                {{ $order->address }}

                            </span>

                        </div>


                    </div>

                </div>

            </div>



            <!-- COMPANY INFORMATION -->

            <div class="col-lg-6">

                <div class="card border-0 shadow-sm h-100">

                    <div class="card-body p-4">


                        <h5 class="fw-bold border-bottom pb-3 mb-4">

                            <i class="bi bi-building me-2"></i>

                            Company Information

                        </h5>


                        <h4 class="fw-bold mb-3">

                            NexXoom

                        </h4>


                        <div class="mb-3">

                            <i class="bi bi-telephone me-2"></i>

                            01633-068139

                        </div>


                        <div class="mb-3">

                            <i class="bi bi-envelope me-2"></i>

                            info@example.com

                        </div>


                        <div class="mb-3">

                            <i class="bi bi-geo-alt me-2"></i>

                            Bangladesh

                        </div>


                        <span class="badge bg-success-subtle text-success">

                            <i class="bi bi-shield-check me-1"></i>

                            Trusted Store

                        </span>


                    </div>

                </div>

            </div>


        </div>



        <!-- =================================
             ORDER PRODUCTS
        ================================== -->

        <div class="card border-0 shadow-sm mb-4">


            <div class="card-body p-4">


                <!-- ORDER HEADER -->

                <div
                    class="d-flex flex-column flex-md-row justify-content-between gap-2 mb-4">


                    <h5 class="fw-bold mb-0">

                        <i class="bi bi-box-seam me-2"></i>

                        Order Products

                    </h5>


                    <small class="text-secondary">

                        {{ $order->created_at->format('d M Y, h:i A') }}

                    </small>


                </div>



                <!-- =================================
                     PRODUCTS
                ================================== -->

                @forelse ($order->items as $item)


                    <div class="row align-items-center border-bottom py-3 g-3">


                        <!-- PRODUCT INFORMATION -->

                        <div class="col-md-6">


                            <div class="d-flex align-items-center gap-3">


                                <!-- PRODUCT IMAGE -->

                                @if ($item->product && $item->product->image)


                                    <img
                                        src="{{ asset('storage/' . $item->product->image) }}"
                                        alt="{{ $item->product->name }}"
                                        class="rounded object-fit-cover"
                                        width="65"
                                        height="65">


                                @else


                                    <div
                                        class="bg-light rounded d-flex align-items-center justify-content-center"
                                        style="width:65px;height:65px;">


                                        <i
                                            class="bi bi-image text-secondary fs-4">
                                        </i>


                                    </div>


                                @endif



                                <!-- PRODUCT NAME + QUANTITY -->

                                <div>


                                    <h6 class="fw-bold mb-1">

                                        {{ $item->product->name ?? 'Product' }}

                                    </h6>


                                    <small class="text-secondary">

                                        Quantity:

                                        <span class="fw-bold text-dark">

                                            {{ $item->quantity }}

                                        </span>

                                    </small>


                                </div>


                            </div>


                        </div>



                        <!-- UNIT PRICE -->

                        <div class="col-md-3 text-md-center">


                            <small class="text-secondary d-block">

                                Unit Price

                            </small>


                            <span class="fw-medium">

                                ৳{{ number_format($item->price, 2) }}

                            </span>


                        </div>



                        <!-- TOTAL PRICE -->

                        <div class="col-md-3 text-md-end">


                            <small class="text-secondary d-block">

                                Total Price

                            </small>


                            <span class="fw-bold">

                                ৳{{ number_format($item->price * $item->quantity, 2) }}

                            </span>


                        </div>


                    </div>


                @empty


                    <div class="alert alert-warning text-center">

                        <i class="bi bi-exclamation-circle me-2"></i>

                        No products found in this order.

                    </div>


                @endforelse



                <!-- =================================
                     ORDER SUMMARY
                ================================== -->

                <div class="row justify-content-end mt-4">


                    <div class="col-md-6 col-lg-4">


                        <!-- SUBTOTAL -->

                        <div class="d-flex justify-content-between mb-2">


                            <span class="text-secondary">

                                Subtotal

                            </span>


                            <span class="fw-medium">

                                ৳{{ number_format($order->subtotal, 2) }}

                            </span>


                        </div>



                        <!-- SHIPPING -->

                        <div class="d-flex justify-content-between mb-2">


                            <span class="text-secondary">

                                Shipping

                            </span>


                            <span class="fw-medium">

                                ৳{{ number_format($order->shipping, 2) }}

                            </span>


                        </div>



                        <hr>



                        <!-- TOTAL -->

                        <div class="d-flex justify-content-between">


                            <span class="fw-bold fs-5">

                                Total

                            </span>


                            <span class="fw-bold fs-5 text-success">

                                ৳{{ number_format($order->total, 2) }}

                            </span>


                        </div>


                    </div>


                </div>


            </div>


        </div>



        <!-- =================================
             PAYMENT INFORMATION
        ================================== -->

        <div class="card border-0 shadow-sm mb-4">


            <div class="card-body p-4">


                <h5 class="fw-bold border-bottom pb-3 mb-4">

                    <i class="bi bi-credit-card me-2"></i>

                    Payment Information

                </h5>



                <div class="row g-3">


                    <!-- PAYMENT METHOD -->

                    <div class="col-md-6">


                        <div class="border rounded-3 p-3">


                            <small class="text-secondary d-block mb-1">

                                Payment Method

                            </small>


                            <span class="fw-bold">

                                {{ $order->paymentMethod }}

                            </span>


                        </div>


                    </div>



                    <!-- PAYMENT STATUS -->

                    <div class="col-md-6">


                        <div class="border rounded-3 p-3">


                            <small class="text-secondary d-block mb-1">

                                Order Status

                            </small>


                              <span class="fw-bold">

                                {{ $order->status }}

                            </span>


                           

                               


                        </div>


                    </div>


                </div>


            </div>


        </div>



        <!-- =================================
             CUSTOMER MESSAGE
        ================================== -->

        @if ($order->message)


            <div class="alert alert-light border mb-4">


                <h6 class="fw-bold">


                    <i class="bi bi-chat-left-text me-2"></i>

                    Your Message


                </h6>


                <p class="mb-0 text-secondary">

                    {{ $order->message }}

                </p>


            </div>


        @endif



        <!-- =================================
             THANK YOU
        ================================== -->

        <div class="text-center py-3">


            <h5 class="fw-bold">

                Thank you for choosing NexXoom ❤️

            </h5>


            <p class="text-secondary mb-0">

                We will contact you shortly regarding your order.

            </p>


        </div>



        <!-- =================================
             BUTTONS
        ================================== -->

        <div
            class="d-flex flex-column flex-sm-row justify-content-center gap-2 mt-3">


            <!-- PRINT -->

            <button
                onclick="window.print()"
                class="btn btn-dark px-4">


                <i class="bi bi-printer me-2"></i>

                Print Order


            </button>



            <!-- CONTINUE SHOPPING -->

            <a
                href="{{ route('home.page') }}"
                class="btn btn-success px-4">


                <i class="bi bi-shop me-2"></i>

                Continue Shopping


            </a>


        </div>



        <!-- =================================
             FOOTER
        ================================== -->

        <div class="text-center border-top mt-5 pt-4">


            <h6 class="fw-bold mb-1">

                NexXoom

            </h6>


            <small class="text-secondary">

                © {{ date('Y') }} NexXoom. All Rights Reserved.

            </small>


        </div>


    </div>



    <!-- Bootstrap JS -->

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js">
    </script>


</body>

</html>

