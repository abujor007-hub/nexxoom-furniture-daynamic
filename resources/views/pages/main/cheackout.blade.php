@include('commonsection.nav')

<link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;500;600&display=swap" rel="stylesheet">
<style>
    .checkout-page {
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Arial, sans-serif;
        color: #1a1a1a;
    }

    .checkout-page h1,
    .checkout-page h5,
    .checkout-page .card-title {
        font-family: 'Lora', Georgia, 'Times New Roman', serif;
        font-weight: 500;
        color: #1a1a1a;
    }

    .checkout-page h1 {
        font-size: 1.9rem;
        font-weight: 500;
    }

    .checkout-page h5 {
        font-size: 1.15rem;
        margin-bottom: 1rem !important;
    }

    .checkout-page .form-control,
    .checkout-page .form-select {
        border: 1px solid #d9d9d9;
        border-radius: 8px;
        padding: 0.65rem 0.9rem;
        font-size: 0.95rem;
        color: #1a1a1a;
    }

    .checkout-page .form-control::placeholder {
        color: #8a8a8a;
    }

    .checkout-page .form-control:focus,
    .checkout-page .form-select:focus {
        border-color: #D9531E;
        box-shadow: 0 0 0 0.15rem rgba(217, 83, 30, 0.15);
    }

    .checkout-page .card {
        border: 1px solid #d9d9d9;
        border-radius: 8px;
        box-shadow: none;
    }

    .checkout-page .card:has(input[type="radio"]:checked) {
        border-color: #1a1a1a;
    }

    .checkout-page .form-check-input:checked {
        background-color: #1a1a1a;
        border-color: #1a1a1a;
    }

    .checkout-page .text-muted.small {
        color: #6b6b6b !important;
        font-size: 0.85rem;
    }

    .checkout-page .btn-order {
        background-color: #D9531E;
        border-color: #D9531E;
        border-radius: 8px;
        color: #fff;
        font-size: 1rem;
        letter-spacing: 0.01em;
    }

    .checkout-page .btn-order:hover {
        background-color: #c2481a;
        border-color: #c2481a;
        color: #fff;
    }

    .checkout-page a.text-danger {
        color: #D9531E !important;
    }

    .checkout-page .badge.bg-light {
        background-color: #efefef !important;
        color: #1a1a1a !important;
        font-weight: 500;
        font-size: 0.78rem;
        border-radius: 6px;
    }

    .checkout-page .text-decoration-line-through {
        color: #8a8a8a;
    }

    .checkout-page hr {
        border-color: #e6e6e6;
        opacity: 1;
    }

    .checkout-page .order-summary-card {
        border: 1px solid #d9d9d9;
        border-radius: 10px;
    }

    .checkout-page .fs-5.fw-semibold {
        font-family: 'Lora', Georgia, serif;
        font-weight: 500;
    }
</style>

@php
    $cheackout = session()->get('cart', []);
    $cartCount = 0;
    $cartTotal = 0;
    $shipping = 150;

    foreach ($cheackout as $item) {
        $cartCount += $item['quantity'];
        $cartTotal += $item['price'] * $item['quantity'];
    }

    // Product id => stock
    $stocks = \App\Models\Product::whereIn('id', array_keys($cheackout))->pluck('quantity', 'id');
@endphp

<!-- ===== CHECKOUT PAGE ===== -->
<div class="container my-5 checkout-page">
    <h1 class="text-center mb-5">Checkout</h1>

    <div class="row g-4">

        <!-- LEFT: Billing Details -->
        <div class="col-lg-7">

            <form action="{{ route('order') }}" method="POST" id="checkoutForm">
                @csrf
                @method('PUT')

                <h5 class="mb-3">Contact information</h5>
                <div class="mb-4">
                    <input type="email" class="form-control" id="email" name="email"
                        placeholder="Email address" required>
                </div>

                <h5 class="mb-3">Billing Details</h5>

                <div class="mb-3">
                    <select class="form-select" id="country" name="country">
                        <option selected>Bangladesh</option>
                    </select>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <input type="text" class="form-control" id="firstName" name="first_name"
                            placeholder="First name" required>
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="form-control" id="lastName" name="last_name"
                            placeholder="Last name" required>
                    </div>
                </div>

                <div class="mb-3">
                    <input type="text" class="form-control" id="company" name="company"
                        placeholder="Company (optional)">
                </div>

                <div class="mb-3">
                    <input type="text" class="form-control" id="address" name="address"
                        placeholder="Address" required>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <input type="text" class="form-control" id="city" name="city"
                            placeholder="City" required>
                    </div>
                    <div class="col-md-6">
                       <select class="form-select" id="state" name="distirct" required>
    <option value="" selected disabled>State / District</option>

    <option value="Dhaka">Dhaka</option>
    <option value="Chattogram">Chattogram</option>
    <option value="Rajshahi">Rajshahi</option>
    <option value="Khulna">Khulna</option>
    <option value="Barishal">Barishal</option>
    <option value="Sylhet">Sylhet</option>
    <option value="Rangpur">Rangpur</option>
    <option value="Mymensingh">Mymensingh</option>
    <option value="Joypurhat">Joypurhat</option>
</select>
                    </div>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <input type="text" class="form-control" id="postalCode" name="post_code"
                            placeholder="Postal code (optional)">
                    </div>
                    <div class="col-md-6">
                        <input type="tel" class="form-control" id="phone" name="phone"
                            placeholder="Phone Number" required>
                    </div>
                </div>

                <div class="mb-4">
                    <textarea class="form-control" id="orderNotes" name="message" rows="3"
                        placeholder="Message (optional)"></textarea>
                </div>

                <h5 class="mb-3">Shipping options</h5>

                <div class="card mb-2" id="shipInsideCard" style="display:none;">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="shippingOption" value="inside_dhaka"
                                id="shipInside" data-cost="80">
                            <label class="form-check-label" for="shipInside">
                                Inside Dhaka
                            </label>
                        </div>
                        <span>৳ 80.00</span>
                    </div>
                </div>

                <div class="card mb-4" id="shipOutsideCard">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="shippingOption" value="outside_dhaka"
                                id="shipOutside" data-cost="{{ $shipping }}" checked>
                            <label class="form-check-label" for="shipOutside">
                                Outside Dhaka
                            </label>
                        </div>
                        <span>৳ {{ $shipping }}.00</span>
                    </div>
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        var stateSelect = document.getElementById('state');
                        var insideCard = document.getElementById('shipInsideCard');
                        var outsideCard = document.getElementById('shipOutsideCard');
                        var insideRadio = document.getElementById('shipInside');
                        var outsideRadio = document.getElementById('shipOutside');
                        var shippingDisplay = document.getElementById('shippingDisplay');
                        var totalDisplay = document.getElementById('totalDisplay');
                        var cartTotal = {{ $cartTotal }};

                        function updateTotals(cost) {
                            if (shippingDisplay) shippingDisplay.textContent = cost;
                            if (totalDisplay) totalDisplay.textContent = cartTotal + cost;
                        }

                        function applyDistrict() {
                            if (!stateSelect) return;

                            if (stateSelect.value === 'Dhaka') {
                                insideCard.style.display = '';
                                outsideCard.style.display = 'none';
                                insideRadio.checked = true;
                                updateTotals(parseInt(insideRadio.dataset.cost, 10));
                            } else {
                                insideCard.style.display = 'none';
                                outsideCard.style.display = '';
                                outsideRadio.checked = true;
                                updateTotals(parseInt(outsideRadio.dataset.cost, 10));
                            }
                        }

                        if (stateSelect) {
                            stateSelect.addEventListener('change', applyDistrict);
                            if (stateSelect.value) applyDistrict();
                        }
                    });
                </script>

                <h5 class="mb-3">Payment options</h5>

                <div class="card mb-2">
                    <div class="card-body">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="paymentMethod" value="cod"
                                id="cod" checked>
                            <label class="form-check-label fw-semibold" for="cod">
                                Cash on Delivery
                            </label>
                        </div>
                        <p class="text-muted small mb-0 ps-4">Pay with cash upon delivery.</p>
                    </div>
                </div>

                <div class="card mb-2">
                    <div class="card-body">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="paymentMethod" value="sslcommerz"
                                id="sslcommerz">
                            <label class="form-check-label fw-semibold" for="sslcommerz">
                                SSLCOMMERZ
                            </label>
                        </div>
                        <p class="text-muted small mb-0 ps-4">Pay online via card, mobile banking, or internet banking.</p>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-body">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="paymentMethod" value="bkash"
                                id="bkash">
                            <label class="form-check-label fw-semibold" for="bkash">
                                bKash / Mobile Banking
                            </label>
                        </div>
                        <p class="text-muted small mb-0 ps-4">Pay using your bKash or mobile banking account.</p>
                    </div>
                </div>

                <hr>

                <p class="small text-muted">
                    By proceeding with your purchase you agree to our Terms and Conditions and
                    <a href="#" class="text-danger">Privacy Policy</a>
                </p>

                <div class="d-flex flex-wrap gap-3">
                    <button type="submit" class="btn btn-order px-5 py-2 fw-semibold flex-grow-1">
                        Place Order
                    </button>
                    <a href="{{ route('shop.page') }}" class="btn btn-outline-secondary px-4 py-2">
                        Return to Cart
                    </a>
                </div>

            </form>
        </div>

        <!-- RIGHT: Order Summary -->
        <div class="col-lg-5">
            <div class="card order-summary-card">
                <div class="card-body">
                    <h5 class="card-title mb-3">Order summary</h5>

                    <div class="flex-grow-1 overflow-auto" style="max-height:400px;">
                        @forelse($cheackout as $item)

                            @php
                                $stockLeft = ($stocks[$item['id']] ?? 0) - $item['quantity'];
                            @endphp

                            <div class="d-flex mb-3">
                                <div class="position-relative me-3 flex-shrink-0">
                                    <img src="{{ asset('storage/' . $item['photo']) }}" alt="{{ $item['name'] }}"
                                        class="rounded" width="56" height="56"
                                        style="object-fit:cover;">
                                    <span class="badge rounded-circle bg-secondary position-absolute top-0 start-0 translate-middle"
                                        id="qty-badge-{{ $item['id'] }}">{{ $item['quantity'] }}</span>
                                </div>

                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between">
                                        <span class="fw-semibold text-truncate">{{ $item['name'] }}</span>
                                        <span>৳<span class="item-total-{{ $item['id'] }}">{{ $item['quantity'] * $item['price'] }}</span></span>
                                    </div>

                                    <small class="text-muted d-block">
                                        Stock left: <span class="stock-left-{{ $item['id'] }}">{{ $stockLeft }}</span>
                                    </small>

                                    <div class="d-flex align-items-center gap-2 mt-1">
                                        <button type="button" class="btn btn-light btn-sm rounded-circle p-1 qty-btn"
                                            data-id="{{ $item['id'] }}" data-action="dec">
                                            <i class="bi bi-dash"></i>
                                        </button>
                                        <span class="px-1 qty-value" id="qty-{{ $item['id'] }}">{{ $item['quantity'] }}</span>
                                        <button type="button" class="btn btn-light btn-sm rounded-circle p-1 qty-btn"
                                            data-id="{{ $item['id'] }}" data-action="inc"
                                            {{ $stockLeft <= 0 ? 'disabled' : '' }}>
                                            <i class="bi bi-plus"></i>
                                        </button>

                                        <a href="{{ route('addtocarditemdelete', $item['id']) }}"
                                            class="btn border-0 p-1 shadow-none ms-auto text-muted">
                                            <i class="bi bi-x fs-5"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        @empty
                            <div class="text-center py-5">
                                <i class="bi bi-cart-x fs-1 text-muted"></i>
                                <p class="text-muted mt-2 mb-0">Your cart is empty</p>
                            </div>
                        @endforelse
                    </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            document.querySelectorAll('.qty-value').forEach(function (counterEl) {
                                var itemId = counterEl.id.replace('qty-', '');
                                var badge = document.getElementById('qty-badge-' + itemId);
                                if (!badge) return;

                                var syncBadge = function () {
                                    badge.textContent = counterEl.textContent.trim();
                                };

                                syncBadge();

                                var observer = new MutationObserver(syncBadge);
                                observer.observe(counterEl, {
                                    childList: true,
                                    characterData: true,
                                    subtree: true
                                });
                            });
                        });
                    </script>

                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal (<span id="itemCount">{{ $cartCount }}</span> items)</span>
                        <span>৳<span id="subtotalDisplay">{{ $cartTotal }}</span></span>
                    </div>

                    <div class="d-flex justify-content-between mb-3">
                        <span>Shipping</span>
                        <span>৳<span id="shippingDisplay">{{ $shipping }}</span></span>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between fs-5 fw-semibold">
                        <span>Total</span>
                        <span>৳<span id="totalDisplay">{{ $shipping + $cartTotal }}</span></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('commonsection.footer')