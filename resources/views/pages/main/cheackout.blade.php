@include('commonsection.nav')

@php
    $cheackout = session()->get('cart', []);
    $cartCount = 0;
    $cartTotal = 0;
    $shipping = 150;

    foreach ($cheackout as $item) {
        $cartCount += $item['quantity'];
        $cartTotal += $item['price'] * $item['quantity'];
    }
@endphp

<!-- ===== CHECKOUT PAGE ===== -->
<div class="container my-5">
    <div class="row g-4">

        <!-- LEFT: Billing Details -->
        <div class="col-lg-8">
            <h3 class="fw-bold mb-4"><i class="bi bi-credit-card me-2"></i>Billing Details</h3>

            <form action="{{ route('order') }}" method="POST" id="checkoutForm">
                @csrf
                @method('PUT')
                <div class="row g-3">

                    <div class="col-md-6">
                        <label for="fullName" class="form-label fw-semibold">Full Name</label>
                        <input type="text" class="form-control" id="fullName" name="fullName" placeholder="John"
                            required>
                    </div>

                    <div class="col-md-6">
                        <label for="address" class="form-label fw-semibold">Address</label>
                        <input type="text" class="form-control" id="address" name="address"
                            placeholder="your current address" required>
                    </div>

                    <div class="col-12">
                        <label for="email" class="form-label fw-semibold">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com"
                            required>
                    </div>

                    <div class="col-12">
                        <label for="phone" class="form-label fw-semibold">Phone Number</label>
                        <input type="tel" class="form-control" id="phone" name="phone" placeholder="+880 1XXX-XXXXXX"
                            required>
                    </div>

                    <div class="col-12">
                        <label for="orderNotes" class="form-label fw-semibold">Message (optional)</label>
                        <textarea class="form-control" id="orderNotes" name="message" rows="4"
                            placeholder="Any special instructions or message…"></textarea>
                    </div>

                    <div class="col-12 mt-3">

                        <h5 class="fw-bold">
                            <i class="bi bi-wallet2 me-2"></i>
                            Payment Method
                        </h5>

                        <div class="border p-3 rounded-3 bg-light">

                            <!-- COD -->
                            <div class="form-check mb-2">

                                <input class="form-check-input" type="radio" name="paymentMethod" value="cod" id="cod"
                                    checked>

                                <label class="form-check-label fw-semibold" for="cod">
                                    <i class="bi bi-cash-stack me-1"></i>
                                    Cash on Delivery
                                </label>

                            </div>


                            <!-- SSLCOMMERZ -->
                            <div class="form-check mb-2">

                                <input class="form-check-input" type="radio" name="paymentMethod" value="sslcommerz"
                                    id="sslcommerz">

                                <label class="form-check-label fw-semibold" for="sslcommerz">
                                    <i class="bi bi-credit-card me-1"></i>
                                    SSLCOMMERZ
                                </label>

                            </div>


                            <!-- BKASH -->
                            <div class="form-check">

                                <input class="form-check-input" type="radio" name="paymentMethod" value="bkash"
                                    id="bkash">

                                <label class="form-check-label fw-semibold" for="bkash">
                                    <i class="bi bi-phone me-1"></i>
                                    bKash / Mobile Banking
                                </label>

                            </div>


                            <small class="text-muted d-block mt-2">

                                <i class="bi bi-lock me-1"></i>

                                Your payment is secure.

                            </small>

                        </div>

                    </div>
                    <div class="col-12 mt-4">
                        <div class="d-flex flex-wrap gap-3">
                            <button type="submit" class="btn btn-success px-5 py-2 fw-bold">
                                <i class="bi bi-check-circle me-2"></i>Place Order
                            </button>
                            <a href="" class="btn btn-outline-secondary px-4 py-2">
                                <i class="bi bi-arrow-left me-2"></i>Return to Cart
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- RIGHT: Order Summary -->
        <div class="col-lg-4">
            <div class="border p-4 rounded-3 bg-white shadow-sm">
                <h5 class="fw-bold mb-3"><i class="bi bi-bag-check me-2"></i>Your Order</h5>

                <div class="flex-grow-1 overflow-auto" style="max-height:400px;">
                    @forelse($cheackout as $item)
                        <div class="card border rounded-3 shadow-sm mb-3">
                            <div class="card-body p-2">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="border rounded-3 d-flex align-items-center justify-content-center flex-shrink-0"
                                        style="width:54px;height:54px;">
                                        <img src="{{ asset('storage/' . $item['photo']) }}" alt="" class="img-fluid rounded"
                                            style="max-height:48px;">
                                    </div>

                                    <div class="flex-grow-1">
                                        <div class="fw-semibold text-dark mb-1 text-truncate">{{ $item['name'] }}</div>
                                        <div class="d-flex align-items-center gap-2">
                                            <button type="button" class="btn btn-light rounded-circle p-1 qty-btn"
                                                data-id="{{ $item['id'] }}" data-action="dec">
                                                <i class="bi bi-dash"></i>
                                            </button>
                                            <span class="px-2 qty-value"
                                                id="qty-{{ $item['id'] }}">{{ $item['quantity'] }}</span>
                                            <button type="button" class="btn btn-light rounded-circle p-1 qty-btn"
                                                data-id="{{ $item['id'] }}" data-action="inc">
                                                <i class="bi bi-plus"></i>
                                            </button>
                                            <span
                                                class="item-total-{{ $item['id'] }}">৳{{ $item['quantity'] * $item['price'] }}</span>
                                        </div>
                                    </div>

                                    <a href="{{ route('addtocarditemdelete', $item['id']) }}"
                                        class="btn border-0 p-1 shadow-none">
                                        <i class="bi bi-x fs-5"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-5">
                            <i class="bi bi-cart-x fs-1 text-muted"></i>
                            <p class="text-muted mt-2 mb-0">Your cart is empty</p>
                        </div>
                    @endforelse
                </div>

                <hr class="my-3">

                <div class="d-flex justify-content-between mb-1">
                    <span>Subtotal (<span id="itemCount">{{ $cartCount }}</span> items)</span>
                    <span class="fw-semibold" id="subtotalDisplay">{{ $cartTotal }}</span>
                </div>

                <div class="d-flex justify-content-between mb-1">
                    <span>Shipping</span>
                    <span class="text-success" id="shippingDisplay">{{ $shipping }}</span>
                </div>

                <hr>

                <div class="d-flex justify-content-between mb-3">
                    <span class="fw-bold fs-6">Total</span>
                    <span class="fw-bold fs-5 text-success" id="totalDisplay">{{ $shipping + $cartTotal }}</span>
                </div>

                <div class="text-center mt-2">
                    <span class="badge bg-light text-dark border py-2 px-3 w-100">
                        <i class="bi bi-shield-check me-1 text-success"></i>Secure checkout · SSL encrypted
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

@include('commonsection.footer')