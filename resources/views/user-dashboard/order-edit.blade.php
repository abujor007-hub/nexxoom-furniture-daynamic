@include('commonsection.nav')
<div class="container py-4">

    {{-- Header --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">

        <div>
            <h3 class="fw-bold mb-1">
                <i class="bi bi-pencil-square me-2"></i>
                Edit Order #{{ $order->id }}
            </h3>

            <p class="text-muted mb-0">
                Update your order information and product quantity
            </p>
        </div>

        <a href="{{ route('orders.page') }}"
           class="btn btn-outline-secondary mt-3 mt-md-0">

            <i class="bi bi-arrow-left me-1"></i>
            Back to Orders

        </a>

    </div>



    <form action="{{ route('orders.update', $order->id) }}"
          method="POST">

        @csrf
        @method('PUT')


        {{-- Customer Information --}}
        <div class="card border-0 shadow-sm mb-4">

            <div class="card-header bg-white py-3">

                <h5 class="fw-bold mb-0">

                    <i class="bi bi-person me-2"></i>

                    Customer Information

                </h5>

            </div>


            <div class="card-body">

                <div class="row g-3">

                    {{-- Full Name --}}
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Full Name
                        </label>

                        <input type="text"
                               name="fullName"
                               class="form-control"
                               value="{{ old('fullName', $order->fullName) }}"
                               required>

                    </div>


                    {{-- Phone --}}
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Phone
                        </label>

                        <input type="text"
                               name="phone"
                               class="form-control"
                               value="{{ old('phone', $order->phone) }}"
                               required>

                    </div>


                    {{-- Email --}}
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Email
                        </label>

                        <input type="email"
                               name="email"
                               class="form-control"
                               value="{{ old('email', $order->email) }}"
                               required>

                    </div>


                    {{-- Address --}}
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Delivery Address
                        </label>

                        <textarea name="address"
                                  class="form-control"
                                  rows="2"
                                  required>{{ old('address', $order->address) }}</textarea>

                    </div>


                    {{-- Message --}}
                    <div class="col-12">

                        <label class="form-label fw-semibold">
                            Message
                        </label>

                        <textarea name="message"
                                  class="form-control"
                                  rows="3"
                                  placeholder="Any special instructions...">{{ old('message', $order->message) }}</textarea>

                    </div>

                </div>

            </div>

        </div>



        {{-- Products --}}
        <div class="card border-0 shadow-sm mb-4">

            <div class="card-header bg-white py-3">

                <h5 class="fw-bold mb-0">

                    <i class="bi bi-cart-check me-2"></i>

                    Order Products

                </h5>

            </div>


            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table align-middle mb-0">

                        <thead class="table-light">

                            <tr>

                                <th class="ps-3">
                                    Product
                                </th>

                                <th>
                                    Price
                                </th>

                                <th style="width: 150px;">
                                    Quantity
                                </th>

                                <th class="text-end pe-3">
                                    Subtotal
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @foreach ($order->items as $item)

                                <tr>

                                    {{-- Product --}}
                                    <td class="ps-3">

                                        <div class="d-flex align-items-center gap-3">

                                            @if($item->product && $item->product->image)

                                                <img src="{{ asset('storage/' . $item->product->image) }}"
                                                     alt="{{ $item->product->name }}"
                                                     width="60"
                                                     height="60"
                                                     class="rounded border object-fit-cover">

                                            @else

                                                <div class="bg-light rounded border d-flex align-items-center justify-content-center"
                                                     style="width:60px;height:60px;">

                                                    <i class="bi bi-image text-muted"></i>

                                                </div>

                                            @endif


                                            <div>

                                                <div class="fw-semibold">

                                                    {{ $item->product->name ?? 'Product unavailable' }}

                                                </div>

                                                <small class="text-muted">

                                                    Product ID:
                                                    {{ $item->product_id }}

                                                </small>

                                            </div>

                                        </div>

                                    </td>


                                    {{-- Price --}}
                                    <td>

                                        ৳{{ number_format($item->price, 2) }}

                                    </td>


                                    {{-- Quantity --}}
                                    <td>

                                        <input type="number"
                                               name="quantity[{{ $item->id }}]"
                                               value="{{ old('quantity.' . $item->id, $item->quantity) }}"
                                               min="1"
                                               class="form-control"
                                               required>

                                    </td>


                                    {{-- Subtotal --}}
                                    <td class="text-end pe-3 fw-semibold">

                                        ৳{{ number_format($item->price * $item->quantity, 2) }}

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

        </div>



        {{-- Order Summary --}}
        <div class="card border-0 shadow-sm mb-4">

            <div class="card-header bg-white py-3">

                <h5 class="fw-bold mb-0">

                    <i class="bi bi-receipt me-2"></i>

                    Current Order Summary

                </h5>

            </div>


            <div class="card-body">

                <div class="d-flex justify-content-between mb-2">

                    <span>
                        Subtotal
                    </span>

                    <strong>
                        ৳{{ number_format($order->subtotal, 2) }}
                    </strong>

                </div>


                <div class="d-flex justify-content-between mb-2">

                    <span>
                        Shipping
                    </span>

                    <strong>
                        ৳{{ number_format($order->shipping, 2) }}
                    </strong>

                </div>


                <hr>


                <div class="d-flex justify-content-between">

                    <span class="fw-bold">
                        Total
                    </span>

                    <strong class="fs-5">
                        ৳{{ number_format($order->total, 2) }}
                    </strong>

                </div>

            </div>

        </div>



        {{-- Buttons --}}
        <div class="d-flex flex-column flex-sm-row justify-content-end gap-2">

            <a href="{{ route('orders.page') }}"
               class="btn btn-outline-secondary">

                <i class="bi bi-x-circle me-1"></i>

                Cancel

            </a>


            <button type="submit"
                    class="btn btn-success">

                <i class="bi bi-check-circle me-1"></i>

                Update Order

            </button>

        </div>

    </form>

</div>

@include('commonsection.footer')