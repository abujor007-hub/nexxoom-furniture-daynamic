@include('commonsection.nav')
<div class="container py-4">

    <!-- HEADER -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">

        <div>

            <h3 class="fw-bold text-nex mb-1">

                <i class="bi bi-bag-check me-2"></i>

                My Orders

            </h3>

            <p class="text-muted mb-0">

                Track, view and manage your orders

            </p>

        </div>


        <a href="{{ route('shop.page') }}"
           class="btn bg-nex text-white fw-semibold">

            <i class="bi bi-shop me-1"></i>

            Continue Shopping

        </a>

    </div>




    <!-- ORDERS -->
    @forelse($orders as $order)

        @php

            $status = strtolower(
                trim(
                    (string) ($order->status ?? 'pending')
                )
            );


            $statusIndex = match($status) {

                'pending' => 1,

                'processing' => 2,

                'shipped' => 3,

                'delivered' => 4,

                default => 0,

            };


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


        <!-- ORDER CARD -->
        <div class="card border-0 shadow-sm rounded-3 mb-4 overflow-hidden">


            <!-- ORDER HEADER -->
            <div class="card-header bg-white p-3">

                <div class="row align-items-center g-3">


                    <!-- ORDER ID -->
                    <div class="col-6 col-md-3">

                        <small class="text-muted d-block">

                            Order ID

                        </small>

                        <span class="fw-bold text-nex">

                            #{{ $order->id }}

                        </span>

                    </div>


                    <!-- ORDER DATE -->
                    <div class="col-6 col-md-3">

                        <small class="text-muted d-block">

                            Order Date

                        </small>

                        <span class="fw-medium">

                            {{ $order->created_at->format('d M Y') }}

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

                        <span class="fw-bold fs-5 text-nex">

                            ৳{{ number_format($order->total, 2) }}

                        </span>

                    </div>

                </div>

            </div>


            <!-- ORDER TRACKING -->
            <div class="card-body border-bottom">

                <h6 class="fw-bold text-nex mb-4">

                    <i class="bi bi-truck me-2"></i>

                    Order Tracking

                </h6>


                @if($status === 'cancelled')

                    <div class="alert alert-danger mb-0">

                        <div class="fw-bold">

                            <i class="bi bi-x-circle me-2"></i>

                            Order Cancelled

                        </div>

                    </div>

                @else

                    <div class="row text-center g-2">


                        <!-- PENDING -->
                        <div class="col-3">

                            <div class="rounded-circle mx-auto d-flex align-items-center justify-content-center

                                @if($status === 'pending')

                                    bg-warning text-dark

                                @elseif($statusIndex > 1)

                                    bg-nex text-white

                                @else

                                    bg-light text-muted

                                @endif"

                                style="width:42px;height:42px;">

                                <i class="bi bi-clock"></i>

                            </div>

                            <small class="d-block mt-2 fw-semibold">

                                Pending

                            </small>

                        </div>


                        <!-- PROCESSING -->
                        <div class="col-3">

                            <div class="rounded-circle mx-auto d-flex align-items-center justify-content-center

                                @if($status === 'processing')

                                    bg-info text-dark

                                @elseif($statusIndex > 2)

                                    bg-nex text-white

                                @else

                                    bg-light text-muted

                                @endif"

                                style="width:42px;height:42px;">

                                <i class="bi bi-box-seam"></i>

                            </div>

                            <small class="d-block mt-2 fw-semibold">

                                Processing

                            </small>

                        </div>


                        <!-- SHIPPED -->
                        <div class="col-3">

                            <div class="rounded-circle mx-auto d-flex align-items-center justify-content-center

                                @if($status === 'shipped')

                                    bg-primary text-white

                                @elseif($statusIndex > 3)

                                    bg-nex text-white

                                @else

                                    bg-light text-muted

                                @endif"

                                style="width:42px;height:42px;">

                                <i class="bi bi-truck"></i>

                            </div>

                            <small class="d-block mt-2 fw-semibold">

                                Shipped

                            </small>

                        </div>


                        <!-- DELIVERED -->
                        <div class="col-3">

                            <div class="rounded-circle mx-auto d-flex align-items-center justify-content-center

                                @if($status === 'delivered')

                                    bg-success text-white

                                @else

                                    bg-light text-muted

                                @endif"

                                style="width:42px;height:42px;">

                                <i class="bi bi-check-circle"></i>

                            </div>

                            <small class="d-block mt-2 fw-semibold">

                                Delivered

                            </small>

                        </div>

                    </div>

                @endif

            </div>


            <!-- PRODUCTS -->
            <div class="card-body border-bottom">

                <h6 class="fw-bold text-nex mb-3">

                    <i class="bi bi-box-seam me-2"></i>

                    Ordered Products

                </h6>


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

                                                @else

                                                    <div class="text-danger">

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

                                        ৳{{ number_format(
                                            $item->price * $item->quantity,
                                            2
                                        ) }}

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="4"
                                        class="text-center text-muted py-3">

                                        No products found.

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>


            <!-- CUSTOMER + DELIVERY -->
            <div class="card-body border-bottom">

                <div class="row g-3">


                    <!-- CUSTOMER -->
                    <div class="col-lg-6">

                        <div class="border rounded-3 p-3 h-100">

                            <h6 class="fw-bold text-nex mb-3">

                                <i class="bi bi-person me-2"></i>

                                Customer Information

                            </h6>


                            <div class="mb-2">

                                <small class="text-muted d-block">

                                    Name

                                </small>

                                <span class="fw-medium">

                                    {{ $order->fullName }}

                                </span>

                            </div>


                            <div class="mb-2">

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


                    <!-- DELIVERY -->
                    <div class="col-lg-6">

                        <div class="border rounded-3 p-3 h-100">

                            <h6 class="fw-bold text-nex mb-3">

                                <i class="bi bi-geo-alt me-2"></i>

                                Delivery Information

                            </h6>


                            <div class="mb-2">

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


            <!-- ORDER SUMMARY -->
            <div class="card-body border-bottom">

                <div class="row justify-content-end">

                    <div class="col-md-5 col-lg-4">

                        <div class="border rounded-3 p-3">

                            <h6 class="fw-bold text-nex mb-3">

                                Order Summary

                            </h6>


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

            </div>


            <!-- ACTIONS -->
            <div class="card-footer bg-white p-3">

                <div class="d-flex flex-column flex-md-row justify-content-between gap-3">


                    <!-- PAYMENT -->
                    <div class="small">

                        <span class="text-muted">

                            Payment:

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


                        <span class="mx-1">

                            •

                        </span>


                        <!-- PAYMENT STATUS -->
                        @if($paymentStatus === 'paid')

                            <span class="badge bg-success">

                                <i class="bi bi-check-circle me-1"></i>

                                Paid

                            </span>


                        @elseif($paymentStatus === 'pending')

                            <span class="badge bg-warning text-dark">

                                <i class="bi bi-clock me-1"></i>

                                Pending

                            </span>


                        @elseif($paymentStatus === 'failed')

                            <span class="badge bg-danger">

                                <i class="bi bi-x-circle me-1"></i>

                                Failed

                            </span>


                        @else

                            <span class="badge bg-secondary">

                                {{ $paymentStatus ?: 'Unknown' }}

                            </span>

                        @endif

                    </div>


                    <!-- BUTTONS -->
                    <div class="d-flex flex-wrap gap-2">


                        <!-- VIEW -->
                        <a href="{{ route('orders.show', $order->id) }}"
                           class="btn btn-outline-primary btn-sm">

                            <i class="bi bi-eye me-1"></i>

                            View

                        </a>


                        <!-- EDIT -->
                        <a href="{{ route('orders.edit', $order->id) }}"
                           class="btn btn-outline-warning btn-sm">

                            <i class="bi bi-pencil-square me-1"></i>

                            Edit

                        </a>


                        <!-- CANCEL -->
                        <form action="{{ route('orders.cancel', $order->id) }}"
                              method="POST"
                              class="d-inline">

                            @csrf

                            @method('DELETE')

                            <button type="submit"
                                    class="btn btn-outline-danger btn-sm">

                                <i class="bi bi-x-circle me-1"></i>

                                Cancel

                            </button>

                        </form>


                        <!-- RE-ORDER -->
                        @if($status === 'delivered')

                            <a href="{{ route('orders.show', $order->id) }}"
                               class="btn btn-outline-success btn-sm">

                                <i class="bi bi-arrow-repeat me-1"></i>

                                Re-order

                            </a>

                        @endif

                    </div>

                </div>

            </div>

        </div>


    @empty


        <!-- NO ORDERS -->
        <div class="card border-0 shadow-sm">

            <div class="card-body text-center py-5">

                <i class="bi bi-bag-x display-1 text-muted"></i>


                <h4 class="fw-bold mt-3">

                    No Orders Yet

                </h4>


                <p class="text-muted">

                    You haven't placed any orders yet.

                </p>


                <a href="{{ route('shop.page') }}"
                   class="btn bg-nex text-white fw-semibold">

                    <i class="bi bi-shop me-1"></i>

                    Start Shopping

                </a>

            </div>

        </div>


    @endforelse

</div>

@include('commonsection.footer')