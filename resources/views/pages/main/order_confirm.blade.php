@include('commonsection.nav')

<div id="downloadArea" class="container-fluid bg-light min-vh-100 py-5">

    <div class="container">

        {{-- Success Message --}}
        @if(session('success'))

            <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4">

                <div class="d-flex align-items-center">

                    <i class="bi bi-check-circle-fill fs-4 me-3"></i>

                    <div>

                        <h6 class="fw-bold mb-1">
                            Order Confirmed!
                        </h6>

                        <p class="mb-0">
                            {{ session('success') }}
                        </p>

                    </div>

                </div>

            </div>

        @endif


        {{-- Header --}}
        <div class="text-center mb-5">

            <div class="mb-3">

                <span class="bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center"
                      style="width:70px;height:70px;">

                    <i class="bi bi-check-lg fs-1"></i>

                </span>

            </div>

            <h1 class="fw-bold">
                Order Confirmed!
            </h1>

            <p class="text-secondary mb-1">
                Thank you for your order {{ $order->first_name }}.
            </p>

            <p class="text-secondary">
                Your order has been successfully placed.
            </p>

        </div>


        {{-- Order Information --}}
        <div class="card border-0 shadow-sm rounded-4 mb-4">

            <div class="card-body p-4">

                <div class="row align-items-center">

                    <div class="col-md-4 mb-3 mb-md-0">

                        <small class="text-secondary d-block">
                            Order Number
                        </small>

                        <h5 class="fw-bold mb-0">
                            #{{ $order->id }}
                        </h5>

                    </div>


                    <div class="col-md-4 mb-3 mb-md-0">

                        <small class="text-secondary d-block">
                            Order Status
                        </small>

                        @if($order->status == 'pending')

                            <span class="badge bg-warning text-dark">
                                Pending
                            </span>

                        @elseif($order->status == 'confirmed')

                            <span class="badge bg-success">
                                Confirmed
                            </span>

                        @elseif($order->status == 'cancelled')

                            <span class="badge bg-danger">
                                Cancelled
                            </span>

                        @else

                            <span class="badge bg-secondary">
                                {{ $order->status }}
                            </span>

                        @endif

                    </div>


                    <div class="col-md-4">

                        <small class="text-secondary d-block">
                            Order Date
                        </small>

                        <strong>
                            {{ $order->created_at->format('d M Y, h:i A') }}
                        </strong>

                    </div>

                </div>

            </div>

        </div>


        <div class="row g-4">


            {{-- LEFT SIDE --}}
            <div class="col-lg-8">


                {{-- Billing Details --}}
                <div class="card border-0 shadow-sm rounded-4 mb-4">

                    <div class="card-header bg-white border-0 p-4">

                        <h5 class="fw-bold mb-0">

                            <i class="bi bi-person-vcard me-2 text-primary"></i>

                            Billing Details

                        </h5>

                    </div>


                    <div class="card-body px-4 pb-4">

                        <div class="row g-3">


                            <div class="col-md-6">

                                <small class="text-secondary">
                                    First Name
                                </small>

                                <p class="fw-semibold mb-0">
                                    {{ $order->first_name }}
                                </p>

                            </div>


                            <div class="col-md-6">

                                <small class="text-secondary">
                                    Last Name
                                </small>

                                <p class="fw-semibold mb-0">
                                    {{ $order->last_name }}
                                </p>

                            </div>


                            <div class="col-md-6">

                                <small class="text-secondary">
                                    Phone
                                </small>

                                <p class="fw-semibold mb-0">
                                    {{ $order->phone }}
                                </p>

                            </div>


                            <div class="col-md-6">

                                <small class="text-secondary">
                                    Email
                                </small>

                                <p class="fw-semibold mb-0">
                                    {{ $order->email }}
                                </p>

                            </div>


                            <div class="col-md-6">

                                <small class="text-secondary">
                                    Country
                                </small>

                                <p class="fw-semibold mb-0">
                                    {{ $order->country }}
                                </p>

                            </div>


                            <div class="col-md-6">

                                <small class="text-secondary">
                                    City
                                </small>

                                <p class="fw-semibold mb-0">
                                    {{ $order->city }}
                                </p>

                            </div>


                            <div class="col-md-6">

                                <small class="text-secondary">
                                    District
                                </small>

                                <p class="fw-semibold mb-0">
                                    {{ $order->distirct }}
                                </p>

                            </div>


                            <div class="col-md-6">

                                <small class="text-secondary">
                                    Post Code
                                </small>

                                <p class="fw-semibold mb-0">
                                    {{ $order->post_code }}
                                </p>

                            </div>


                            <div class="col-12">

                                <small class="text-secondary">
                                    Address
                                </small>

                                <p class="fw-semibold mb-0">
                                    {{ $order->address }}
                                </p>

                            </div>


                            @if($order->message)

                                <div class="col-12">

                                    <small class="text-secondary">
                                        Message
                                    </small>

                                    <p class="fw-semibold mb-0">
                                        {{ $order->message }}
                                    </p>

                                </div>

                            @endif


                        </div>

                    </div>

                </div>



                {{-- Shop Details --}}
                <div class="card border-0 shadow-sm rounded-4 mb-4">

                    <div class="card-header bg-white border-0 p-4">

                        <h5 class="fw-bold mb-0">

                            <i class="bi bi-shop me-2 text-primary"></i>

                            Shop Details

                        </h5>

                    </div>


                    <div class="card-body px-4 pb-4">

                        <div class="d-flex align-items-center">


                            {{-- Shop Icon --}}
                            <div class="bg-primary bg-opacity-10 rounded-3 p-3 me-3">

                                <i class="bi bi-shop text-primary fs-3"></i>

                            </div>


                            {{-- Shop Information --}}
                            <div>

                                <h5 class="fw-bold mb-1">
                                    NexXoom
                                </h5>

                                <p class="text-secondary mb-1">

                                    <i class="bi bi-telephone me-2"></i>

                                    01633-068139

                                </p>


                                <p class="text-secondary mb-1">

                                    <i class="bi bi-envelope me-2"></i>

                                    info@example.com

                                </p>


                                <p class="text-secondary mb-2">

                                    <i class="bi bi-geo-alt me-2"></i>

                                    Bangladesh

                                </p>


                                <span class="badge bg-success">

                                    <i class="bi bi-patch-check-fill me-1"></i>

                                    Trusted Store

                                </span>

                            </div>

                        </div>

                    </div>

                </div>



                {{-- Product Details --}}
                <div class="card border-0 shadow-sm rounded-4 mb-4">

                    <div class="card-header bg-white border-0 p-4">

                        <h5 class="fw-bold mb-0">

                            <i class="bi bi-bag-check me-2 text-primary"></i>

                            Product Details

                        </h5>

                    </div>


                    <div class="card-body p-0">

                        @foreach($order->items as $item)

                            <div class="border-top p-4">

                                <div class="row align-items-center g-3">


                                    {{-- Product Image --}}
                                    <div class="col-3 col-md-2">

                                        @if($item->product && $item->product->image)

                                            <img
                                                src="{{ asset('storage/' . $item->product->image) }}"
                                                class="img-fluid rounded-3"
                                                alt="{{ $item->product->title }}">

                                        @else

                                            <div class="bg-light rounded-3 text-center p-3">

                                                <i class="bi bi-image text-secondary fs-3"></i>

                                            </div>

                                        @endif

                                    </div>


                                    {{-- Product --}}
                                    <div class="col-9 col-md-4">

                                        <h6 class="fw-bold mb-1">

                                            {{ $item->product->title ?? 'Product' }}

                                        </h6>

                                        <small class="text-secondary">

                                            Product ID:

                                            {{ $item->product_id }}

                                        </small>

                                    </div>


                                    {{-- Quantity --}}
                                    <div class="col-4 col-md-2">

                                        <small class="text-secondary d-block">
                                            Quantity
                                        </small>

                                        <strong>
                                            × {{ $item->quantity }}
                                        </strong>

                                    </div>


                                    {{-- Price --}}
                                    <div class="col-4 col-md-2">

                                        <small class="text-secondary d-block">
                                            Price
                                        </small>

                                        <strong>

                                            ৳{{ number_format($item->price, 2) }}

                                        </strong>

                                    </div>


                                    {{-- Total --}}
                                    <div class="col-4 col-md-2 text-end">

                                        <small class="text-secondary d-block">
                                            Total
                                        </small>

                                        <strong class="text-success">

                                            ৳{{ number_format($item->price * $item->quantity, 2) }}

                                        </strong>

                                    </div>


                                </div>

                            </div>

                        @endforeach

                    </div>

                </div>


            </div>



            {{-- RIGHT SIDE --}}
            <div class="col-lg-4">


                {{-- Payment Details --}}
                <div class="card border-0 shadow-sm rounded-4 mb-4">

                    <div class="card-header bg-white border-0 p-4">

                        <h5 class="fw-bold mb-0">

                            <i class="bi bi-credit-card me-2 text-primary"></i>

                            Payment Details

                        </h5>

                    </div>


                    <div class="card-body px-4 pb-4">

                        <div class="d-flex justify-content-between mb-3">

                            <span class="text-secondary">
                                Payment Method
                            </span>

                            <strong>

                                @if($order->paymentMethod == 'cod')

                                    Cash on Delivery

                                @elseif($order->paymentMethod == 'bkash')

                                    bKash

                                @elseif($order->paymentMethod == 'sslcommerz')

                                    SSLCommerz

                                @else

                                    {{ $order->paymentMethod }}

                                @endif

                            </strong>

                        </div>


                        <div class="d-flex justify-content-between">

                            <span class="text-secondary">
                                Payment Status
                            </span>

                            @if($order->paymentMethod == 'cod')

                                <span class="badge bg-warning text-dark">
                                    Pending
                                </span>

                            @else

                                <span class="badge bg-success">
                                    Processing
                                </span>

                            @endif

                        </div>

                    </div>

                </div>



                {{-- Order Summary --}}
                <div class="card border-0 shadow-sm rounded-4">

                    <div class="card-header bg-white border-0 p-4">

                        <h5 class="fw-bold mb-0">

                            <i class="bi bi-receipt me-2 text-primary"></i>

                            Order Summary

                        </h5>

                    </div>


                    <div class="card-body px-4 pb-4">


                        <div class="d-flex justify-content-between mb-3">

                            <span class="text-secondary">
                                Subtotal
                            </span>

                            <strong>

                                ৳{{ number_format($order->subtotal, 2) }}

                            </strong>

                        </div>


                        <div class="d-flex justify-content-between mb-3">

                            <span class="text-secondary">
                                Shipping
                            </span>

                            <strong>

                                ৳{{ number_format($order->shipping, 2) }}

                            </strong>

                        </div>


                        <hr>


                        <div class="d-flex justify-content-between align-items-center">

                            <span class="fw-bold fs-5">
                                Total
                            </span>

                            <span class="text-success fw-bold fs-4">

                                ৳{{ number_format($order->total, 2) }}

                            </span>

                        </div>


                    </div>

                </div>



                {{-- Download + Continue Shopping --}}
                <div class="d-grid gap-2 mt-4">


                    {{-- Download Order --}}
                    <button type="button"
                            onclick="downloadOrder()"
                            class="btn btn-primary rounded-pill py-2">

                        <i class="bi bi-download me-2"></i>

                        Download Order

                    </button>


                    {{-- Continue Shopping --}}
                    <a href="{{ url('/') }}"
                       class="btn btn-dark rounded-pill py-2">

                        <i class="bi bi-house me-2"></i>

                        Continue Shopping

                    </a>

                </div>


            </div>

        </div>



        {{-- Bottom --}}
        <div class="text-center mt-5">

            <p class="text-secondary mb-1">

                <i class="bi bi-envelope me-1"></i>

                Order confirmation has been sent to

            </p>

            <strong>
                {{ $order->email }}
            </strong>

        </div>


    </div>

</div>


{{-- html2pdf Library --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>


<script>

    function downloadOrder() {

        const element = document.getElementById('downloadArea');

        const button = event.currentTarget;

        // Button temporarily hide
        button.style.display = 'none';


        const options = {

            margin: 5,

            filename: 'Order-{{ $order->id }}.pdf',

            image: {
                type: 'jpeg',
                quality: 0.98
            },

            html2canvas: {
                scale: 2,
                useCORS: true,
                scrollY: 0
            },

            jsPDF: {
                unit: 'mm',
                format: 'a4',
                orientation: 'portrait'
            }

        };


        html2pdf()

            .set(options)

            .from(element)

            .save()

            .then(function () {

                // Download শেষ হলে button আবার show
                button.style.display = 'block';

            });

    }

</script>


@include('commonsection.footer')