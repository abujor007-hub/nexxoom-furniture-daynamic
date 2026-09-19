@extends('pages.layout.layout')

@section('content')




    {{-- PAGE HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h4 class="mb-1">

                <i class="bi bi-receipt-cutoff text-success me-2"></i>

                Order Details

            </h4>

            <small class="text-muted">

                Order #{{ $order->id }}

            </small>

        </div>


        <a href="{{ url()->previous() }}"
           class="btn btn-outline-secondary btn-sm">

            <i class="bi bi-arrow-left me-1"></i>

            Back

        </a>

    </div>



    <div class="row g-4">


        {{-- CUSTOMER INFORMATION --}}
        <div class="col-lg-4">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-header bg-white py-3">

                    <h6 class="mb-0">

                        <i class="bi bi-person-fill text-primary me-2"></i>

                        Customer Information

                    </h6>

                </div>


                <div class="card-body">

                    <div class="mb-3">

                        <small class="text-muted">
                            Customer Name
                        </small>

                        <div class="fw-semibold">

                            {{ $order->fullName }}

                        </div>

                    </div>


                    <div class="mb-3">

                        <small class="text-muted">
                            Phone
                        </small>

                        <div>

                            <i class="bi bi-telephone me-1"></i>

                            {{ $order->phone }}

                        </div>

                    </div>


                    <div class="mb-3">

                        <small class="text-muted">
                            Email
                        </small>

                        <div>

                            <i class="bi bi-envelope me-1"></i>

                            {{ $order->email }}

                        </div>

                    </div>


                    <div class="mb-3">

                        <small class="text-muted">
                            Address
                        </small>

                        <div>

                            <i class="bi bi-geo-alt me-1"></i>

                            {{ $order->address }}

                        </div>

                    </div>


                    @if($order->message)

                        <div>

                            <small class="text-muted">
                                Customer Message
                            </small>

                            <div class="mt-1">

                                {{ $order->message }}

                            </div>

                        </div>

                    @endif

                </div>

            </div>

        </div>



        {{-- ORDER INFORMATION --}}
        <div class="col-lg-4">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-header bg-white py-3">

                    <h6 class="mb-0">

                        <i class="bi bi-cart-check-fill text-success me-2"></i>

                        Order Information

                    </h6>

                </div>


                <div class="card-body">

                    <div class="d-flex justify-content-between mb-3">

                        <span class="text-muted">
                            Order ID
                        </span>

                        <strong>
                            #{{ $order->id }}
                        </strong>

                    </div>


                    <div class="d-flex justify-content-between mb-3">

                        <span class="text-muted">
                            Order Date
                        </span>

                        <span>

                            {{ $order->created_at->format('d M Y, h:i A') }}

                        </span>

                    </div>


                    <div class="d-flex justify-content-between mb-3">

                        <span class="text-muted">
                            Payment Method
                        </span>

                        <span class="badge bg-secondary">

                            {{ $order->paymentMethod }}

                        </span>

                    </div>


                    <div class="d-flex justify-content-between mb-3">

                        <span class="text-muted">
                            Payment Status
                        </span>


                        @if($order->paymentStatus == 'pending')

                            <span class="badge bg-warning text-dark">
                                Pending
                            </span>

                        @else

                            <span class="badge bg-success">

                                {{ ucfirst($order->paymentStatus) }}

                            </span>

                        @endif

                    </div>


                    <div class="d-flex justify-content-between">

                        <span class="text-muted">
                            Order Status
                        </span>


                        @if($order->status == 'pending')

                            <span class="badge bg-warning text-dark">

                                <i class="bi bi-clock me-1"></i>

                                Pending

                            </span>


                        @elseif($order->status == 'processing')

                            <span class="badge bg-info">

                                <i class="bi bi-arrow-repeat me-1"></i>

                                Processing

                            </span>


                        @elseif($order->status == 'delivered')

                            <span class="badge bg-success">

                                <i class="bi bi-check-circle-fill me-1"></i>

                                Delivered

                            </span>


                        @elseif($order->status == 'cancelled')

                            <span class="badge bg-danger">

                                <i class="bi bi-x-circle-fill me-1"></i>

                                Cancelled

                            </span>


                        @else

                            <span class="badge bg-secondary">

                                {{ $order->status }}

                            </span>

                        @endif

                    </div>

                </div>

            </div>

        </div>



        {{-- COMPANY INFORMATION --}}
        <div class="col-lg-4">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-header bg-white py-3">

                    <h6 class="mb-0">

                        <i class="bi bi-building-fill text-primary me-2"></i>

                        Company Information

                    </h6>

                </div>


                <div class="card-body">

                    <h5 class="fw-bold">

                        NexXoom Furniture

                    </h5>


                    <p class="text-muted mb-2">

                        Furniture & Home Interior

                    </p>


                    <div class="mb-2">

                        <i class="bi bi-telephone-fill me-2"></i>

                        01633-068139

                    </div>


                    <div class="mb-2">

                        <i class="bi bi-envelope-fill me-2"></i>

                        support@nexxoom.com

                    </div>


                    <div>

                        <i class="bi bi-globe2 me-2"></i>

                        nexxoom.com

                    </div>

                </div>

            </div>

        </div>



        {{-- CHANGE STATUS --}}
        <div class="col-lg-4">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-header bg-white py-3">

                    <h6 class="mb-0">

                        <i class="bi bi-arrow-repeat text-success me-2"></i>

                        Change Order Status

                    </h6>

                </div>


                <div class="card-body">


                    <div class="mb-3">

                        <label class="form-label fw-semibold">

                            Current Status

                        </label>


                        @if($order->status == 'pending')

                            <div>

                                <span class="badge bg-warning text-dark">

                                    <i class="bi bi-clock me-1"></i>

                                    Pending

                                </span>

                            </div>


                        @elseif($order->status == 'processing')

                            <div>

                                <span class="badge bg-info">

                                    <i class="bi bi-arrow-repeat me-1"></i>

                                    Processing

                                </span>

                            </div>


                        @elseif($order->status == 'delivered')

                            <div>

                                <span class="badge bg-success">

                                    <i class="bi bi-check-circle-fill me-1"></i>

                                    Delivered

                                </span>

                            </div>


                        @elseif($order->status == 'cancelled')

                            <div>

                                <span class="badge bg-danger">

                                    <i class="bi bi-x-circle-fill me-1"></i>

                                    Cancelled

                                </span>

                            </div>


                        @else

                            <div>

                                <span class="badge bg-secondary">

                                    {{ $order->status }}

                                </span>

                            </div>

                        @endif

                    </div>



                    <form action="{{ route('admin.order.status.update', $order->id) }}"
                          method="POST">

                        @csrf

                        @method('PUT')


                        <div class="mb-3">

                            <label class="form-label fw-semibold">

                                Select New Status

                            </label>


                            <select name="status"
                                    class="form-select"
                                    required>

                                <option value="pending"
                                    {{ $order->status == 'pending' ? 'selected' : '' }}>

                                    Pending

                                </option>


                                <option value="processing"
                                    {{ $order->status == 'processing' ? 'selected' : '' }}>

                                    Processing

                                </option>


                                <option value="delivered"
                                    {{ $order->status == 'delivered' ? 'selected' : '' }}>

                                    Delivered

                                </option>


                                <option value="cancelled"
                                    {{ $order->status == 'cancelled' ? 'selected' : '' }}>

                                    Cancelled

                                </option>

                            </select>

                        </div>


                        <button type="submit"
                                class="btn btn-success w-100">

                            <i class="bi bi-check2-circle me-1"></i>

                            Update Status

                        </button>

                    </form>

                </div>

            </div>

        </div>



        {{-- ORDER ITEMS --}}
        <div class="col-12">

            <div class="card border-0 shadow-sm">

                <div class="card-header bg-white py-3">

                    <h6 class="mb-0">

                        <i class="bi bi-box-seam-fill text-success me-2"></i>

                        Ordered Products

                    </h6>

                </div>


                <div class="card-body">

                    <div class="table-responsive">

                        <table class="table table-hover align-middle">

                            <thead class="table-light">

                                <tr>

                                    <th>#</th>

                                    <th>Product</th>

                                    <th>Price</th>

                                    <th>Quantity</th>

                                    <th class="text-end">
                                        Subtotal
                                    </th>

                                </tr>

                            </thead>


                            <tbody>

                                @forelse($order->items as $key => $item)

                                    <tr>

                                        <td>
                                            {{ $key + 1 }}
                                        </td>


                                        <td>

                                            <div class="d-flex align-items-center gap-2">

                                                @if($item->product && $item->product->image)

                                                    <img
                                                        src="{{ asset('storage/' . $item->product->image) }}"
                                                        width="55"
                                                        height="55"
                                                        class="rounded border"
                                                        style="object-fit: cover;"
                                                        alt="Product">

                                                @endif


                                                <div>

                                                    <div class="fw-semibold">

                                                        {{ $item->product->title ?? 'Product Deleted' }}

                                                    </div>

                                                </div>

                                            </div>

                                        </td>


                                        <td>

                                            ৳{{ number_format($item->price, 2) }}

                                        </td>


                                        <td>

                                            {{ $item->quantity }}

                                        </td>


                                        <td class="text-end">

                                            <strong>

                                                ৳{{ number_format($item->price * $item->quantity, 2) }}

                                            </strong>

                                        </td>

                                    </tr>


                                @empty

                                    <tr>

                                        <td colspan="5"
                                            class="text-center text-muted py-4">

                                            No products found.

                                        </td>

                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>



        {{-- ORDER TOTAL --}}
        <div class="col-lg-5 ms-auto">

            <div class="card border-0 shadow-sm">

                <div class="card-header bg-white py-3">

                    <h6 class="mb-0">

                        <i class="bi bi-calculator-fill text-success me-2"></i>

                        Order Summary

                    </h6>

                </div>


                <div class="card-body">

                    <div class="d-flex justify-content-between mb-2">

                        <span>
                            Subtotal
                        </span>

                        <span>

                            ৳{{ number_format($order->subtotal, 2) }}

                        </span>

                    </div>


                    <div class="d-flex justify-content-between mb-3">

                        <span>
                            Shipping
                        </span>

                        <span>

                            ৳{{ number_format($order->shipping, 2) }}

                        </span>

                    </div>


                    <hr>


                    <div class="d-flex justify-content-between">

                        <strong class="fs-5">

                            Grand Total

                        </strong>

                        <strong class="fs-5 text-success">

                            ৳{{ number_format($order->total, 2) }}

                        </strong>

                    </div>

                </div>

            </div>

        </div>


    </div>

</div>

@endsection