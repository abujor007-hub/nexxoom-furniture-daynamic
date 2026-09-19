@include('commonsection.nav')
<div class="container py-4">

    @php
        $status = strtolower(trim((string) ($order->status ?? 'pending')));

        $statusSteps = [
            'pending' => 1,
            'processing' => 2,
            'shipped' => 3,
            'delivered' => 4,
        ];

        $statusIndex = $statusSteps[$status] ?? 0;

        $paymentStatus = strtolower(
            trim(
                (string) $order->getRawOriginal('paymentStatus')
            )
        );

        $paymentMethod = strtolower(
            trim(
                (string) $order->getRawOriginal('paymentMethod')
            )
        );
    @endphp


    <!-- HEADER -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">

        <div>

            <h3 class="fw-bold text-nex mb-1">

                <i class="bi bi-bag-check me-2"></i>

                Order #{{ $order->id }}

            </h3>

            <p class="text-muted mb-0">
                Track, view and manage your order
            </p>

        </div>


        <div class="d-flex gap-2">

            <a href="{{ route('orders.page') }}"
               class="btn btn-outline-secondary">

                <i class="bi bi-arrow-left me-1"></i>

                My Orders

            </a>


            <a href="{{ route('shop.page') }}"
               class="btn bg-nex text-white fw-semibold">

                <i class="bi bi-shop me-1"></i>

                Continue Shopping

            </a>

        </div>

    </div>


    <!-- SUCCESS MESSAGE -->
    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show">

            <i class="bi bi-check-circle me-2"></i>

            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    <!-- ERROR MESSAGE -->
    @if(session('error'))

        <div class="alert alert-danger alert-dismissible fade show">

            <i class="bi bi-exclamation-circle me-2"></i>

            {{ session('error') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    <!-- ORDER HEADER CARD -->
    <div class="card border-0 shadow-sm rounded-3 mb-4">

        <div class="card-body">

            <div class="row align-items-center g-4">

                <!-- ORDER ID -->
                <div class="col-6 col-md-3">

                    <small class="text-muted d-block">
                        Order ID
                    </small>

                    <span class="fw-bold text-nex fs-5">
                        #{{ $order->id }}
                    </span>

                </div>


                <!-- ORDER DATE -->
                <div class="col-6 col-md-3">

                    <small class="text-muted d-block">
                        Order Date
                    </small>

                    <span class="fw-medium">

                        {{ $order->created_at->format('d M Y, h:i A') }}

                    </span>

                </div>


                <!-- ORDER STATUS -->
                <div class="col-6 col-md-3">

                    <small class="text-muted d-block">
                        Order Status
                    </small>


                    @if($status === 'pending')

                        <span class="badge bg-warning text-dark px-3 py-2">

                            <i class="bi bi-clock me-1"></i>

                            Pending

                        </span>


                    @elseif($status === 'processing')

                        <span class="badge bg-info text-dark px-3 py-2">

                            <i class="bi bi-arrow-repeat me-1"></i>

                            Processing

                        </span>


                    @elseif($status === 'shipped')

                        <span class="badge bg-primary px-3 py-2">

                            <i class="bi bi-truck me-1"></i>

                            Shipped

                        </span>


                    @elseif($status === 'delivered')

                        <span class="badge bg-success px-3 py-2">

                            <i class="bi bi-check-circle me-1"></i>

                            Delivered

                        </span>


                    @elseif($status === 'cancelled')

                        <span class="badge bg-danger px-3 py-2">

                            <i class="bi bi-x-circle me-1"></i>

                            Cancelled

                        </span>


                    @else

                        <span class="badge bg-secondary px-3 py-2">

                            {{ ucfirst($status) }}

                        </span>

                    @endif

                </div>


                <!-- TOTAL -->
                <div class="col-6 col-md-3 text-md-end">

                    <small class="text-muted d-block">
                        Total
                    </small>

                    <span class="fw-bold fs-4 text-nex">

                        ৳{{ number_format($order->total, 2) }}

                    </span>

                </div>

            </div>

        </div>

    </div>


    

    <!-- ORDERED PRODUCTS -->
    <div class="card border-0 shadow-sm rounded-3 mb-4">

        <div class="card-body">

            <h5 class="fw-bold text-nex mb-3">

                <i class="bi bi-box-seam me-2"></i>

                Ordered Products

            </h5>


            <div class="table-responsive">

                <table class="table align-middle mb-0">

                    <thead class="table-light">

                        <tr>

                            <th>
                                Product
                            </th>

                            <th class="text-center">
                                Price
                            </th>

                            <th class="text-center">
                                Qty
                            </th>

                            <th class="text-end">
                                Subtotal
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($order->items as $item)

                            <tr>

                                <!-- PRODUCT -->
                                <td>

                                    <div class="d-flex align-items-center gap-3">

                                        <div class="border rounded-3 d-flex align-items-center justify-content-center flex-shrink-0"
                                             style="width:60px;height:60px;">

                                            @if($item->product && $item->product->image)

                                                <img src="{{ asset('storage/' . $item->product->image) }}"
                                                     class="img-fluid rounded"
                                                     style="max-height:55px;"
                                                     alt="{{ $item->product->name }}">

                                            @else

                                                <i class="bi bi-image text-muted fs-4"></i>

                                            @endif

                                        </div>


                                        <div>

                                            @if($item->product)

                                                <div class="fw-semibold">

                                                    {{ $item->product->name }}

                                                </div>

                                                <small class="text-muted">

                                                    Product ID: {{ $item->product->id }}

                                                </small>

                                            @else

                                                <div class="text-danger fw-semibold">

                                                    Product Deleted

                                                </div>

                                            @endif

                                        </div>

                                    </div>

                                </td>


                                <!-- PRICE -->
                                <td class="text-center">

                                    ৳{{ number_format($item->price, 2) }}

                                </td>


                                <!-- QUANTITY -->
                                <td class="text-center">

                                    <span class="badge bg-light text-dark border px-3 py-2">

                                        {{ $item->quantity }}

                                    </span>

                                </td>


                                <!-- SUBTOTAL -->
                                <td class="text-end fw-semibold">

                                    ৳{{ number_format($item->price * $item->quantity, 2) }}

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="4"
                                    class="text-center text-muted py-4">

                                    No products found for this order.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>


    <!-- CUSTOMER + DELIVERY -->
    <div class="row g-4 mb-4">

        <!-- CUSTOMER -->
        <div class="col-lg-6">

            <div class="card border-0 shadow-sm rounded-3 h-100">

                <div class="card-body">

                    <h5 class="fw-bold text-nex mb-3">

                        <i class="bi bi-person me-2"></i>

                        Customer Information

                    </h5>


                    <div class="mb-3">

                        <small class="text-muted d-block">
                            Name
                        </small>

                        <span class="fw-medium">
                            {{ $order->fullName }}
                        </span>

                    </div>


                    <div class="mb-3">

                        <small class="text-muted d-block">
                            Phone
                        </small>

                        <span class="fw-medium">
                            {{ $order->phone }}
                        </span>

                    </div>


                    <div>

                        <small class="text-muted d-block">
                            Email
                        </small>

                        <span class="fw-medium text-break">
                            {{ $order->email }}
                        </span>

                    </div>

                </div>

            </div>

        </div>


        <!-- DELIVERY -->
        <div class="col-lg-6">

            <div class="card border-0 shadow-sm rounded-3 h-100">

                <div class="card-body">

                    <h5 class="fw-bold text-nex mb-3">

                        <i class="bi bi-geo-alt me-2"></i>

                        Delivery Information

                    </h5>


                    <div class="mb-3">

                        <small class="text-muted d-block">
                            Address
                        </small>

                        <span class="fw-medium">
                            {{ $order->address }}
                        </span>

                    </div>


                    @if($order->message)

                        <div>

                            <small class="text-muted d-block">
                                Message
                            </small>

                            <span class="fw-medium">
                                {{ $order->message }}
                            </span>

                        </div>

                    @endif

                </div>

            </div>

        </div>

    </div>


    <!-- ORDER SUMMARY + PAYMENT -->
    <div class="row g-4 mb-4">

        <!-- SUMMARY -->
        <div class="col-lg-6">

            <div class="card border-0 shadow-sm rounded-3 h-100">

                <div class="card-body">

                    <h5 class="fw-bold text-nex mb-3">

                        <i class="bi bi-receipt me-2"></i>

                        Order Summary

                    </h5>


                    <div class="d-flex justify-content-between mb-2">

                        <span class="text-muted">
                            Subtotal
                        </span>

                        <span>
                            ৳{{ number_format($order->subtotal, 2) }}
                        </span>

                    </div>


                    <div class="d-flex justify-content-between mb-2">

                        <span class="text-muted">
                            Shipping
                        </span>

                        <span>
                            ৳{{ number_format($order->shipping, 2) }}
                        </span>

                    </div>


                    <hr>


                    <div class="d-flex justify-content-between">

                        <span class="fw-bold">
                            Grand Total
                        </span>

                        <span class="fw-bold fs-5 text-nex">

                            ৳{{ number_format($order->total, 2) }}

                        </span>

                    </div>

                </div>

            </div>

        </div>


        <!-- PAYMENT -->
        <div class="col-lg-6">

            <div class="card border-0 shadow-sm rounded-3 h-100">

                <div class="card-body">

                    <h5 class="fw-bold text-nex mb-3">

                        <i class="bi bi-credit-card me-2"></i>

                        Payment Information

                    </h5>


                    <!-- PAYMENT METHOD -->
                    <div class="d-flex justify-content-between align-items-center mb-3">

                        <span class="text-muted">
                            Payment Method
                        </span>


                        <strong>

                            @if($paymentMethod === 'cod')

                                Cash On Delivery

                            @elseif($paymentMethod === 'bkash')

                                bKash

                            @elseif($paymentMethod === 'sslcommerz')

                                SSLCommerz

                            @else

                                {{ $order->getRawOriginal('paymentMethod') ?? 'Not Available' }}

                            @endif

                        </strong>

                    </div>


                    <!-- PAYMENT STATUS -->
                    <div class="d-flex justify-content-between align-items-center">

                        <span class="text-muted">
                            Payment Status
                        </span>


                        @if($paymentStatus === 'paid')

                            <span class="badge bg-success px-3 py-2">

                                <i class="bi bi-check-circle me-1"></i>

                                Paid

                            </span>


                        @elseif($paymentStatus === 'pending')

                            <span class="badge bg-warning text-dark px-3 py-2">

                                <i class="bi bi-clock me-1"></i>

                                Pending

                            </span>


                        @elseif($paymentStatus === 'processing')

                            <span class="badge bg-info text-dark px-3 py-2">

                                <i class="bi bi-arrow-repeat me-1"></i>

                                Processing

                            </span>


                        @elseif($paymentStatus === 'failed')

                            <span class="badge bg-danger px-3 py-2">

                                <i class="bi bi-x-circle me-1"></i>

                                Failed

                            </span>


                        @elseif($paymentStatus === 'cancelled')

                            <span class="badge bg-danger px-3 py-2">

                                <i class="bi bi-x-circle me-1"></i>

                                Cancelled

                            </span>


                        @else

                            <span class="badge bg-secondary px-3 py-2">

                                {{ $paymentStatus ?: 'Unknown' }}

                            </span>

                        @endif

                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- ORDER INFORMATION -->
    <div class="card border-0 shadow-sm rounded-3 mb-4">

        <div class="card-body">

            <h5 class="fw-bold text-nex mb-3">

                <i class="bi bi-info-circle me-2"></i>

                Order Information

            </h5>


            <div class="row g-3">

                <div class="col-md-6">

                    <small class="text-muted d-block">
                        Order ID
                    </small>

                    <strong>
                        #{{ $order->id }}
                    </strong>

                </div>


                <div class="col-md-6">

                    <small class="text-muted d-block">
                        Order Status
                    </small>


                    @if($status === 'pending')

                        <span class="badge bg-warning text-dark">
                            Pending
                        </span>

                    @elseif($status === 'processing')

                        <span class="badge bg-info text-dark">
                            Processing
                        </span>

                    @elseif($status === 'shipped')

                        <span class="badge bg-primary">
                            Shipped
                        </span>

                    @elseif($status === 'delivered')

                        <span class="badge bg-success">
                            Delivered
                        </span>

                    @elseif($status === 'cancelled')

                        <span class="badge bg-danger">
                            Cancelled
                        </span>

                    @endif

                </div>

            </div>

        </div>

    </div>


    <!-- ACTIONS -->
    <div class="d-flex flex-wrap justify-content-end gap-2 mb-4">

        <!-- EDIT ONLY PENDING -->
        @if($status === 'pending')

            <a href="{{ route('orders.edit', $order->id) }}"
               class="btn btn-outline-warning">

                <i class="bi bi-pencil-square me-1"></i>

                Edit Order

            </a>


            <!-- CANCEL -->
            <form action="{{ route('orders.cancel', $order->id) }}"
                  method="POST"
                  class="d-inline"
                  onsubmit="return confirm('Are you sure you want to cancel this order?');">

                @csrf

                @method('DELETE')

                <button type="submit"
                        class="btn btn-outline-danger">

                    <i class="bi bi-x-circle me-1"></i>

                    Cancel Order

                </button>

            </form>

        @endif


        <!-- BACK -->
        <a href="{{ route('orders.page') }}"
           class="btn btn-outline-secondary">

            <i class="bi bi-arrow-left me-1"></i>

            My Orders

        </a>

    </div>

</div>

@include('commonsection.footer')