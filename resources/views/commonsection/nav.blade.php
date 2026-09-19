
@php

    $cart = session()->get('cart', []);
    $cartCount = 0;
    $cartTotal = 0;

    foreach ($cart as $item) {
        $cartCount += $item['quantity'];
        $cartTotal += $item['price'] * $item['quantity'];

  
   
    }
@endphp

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>NexXoom</title>


    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
        rel="stylesheet">

    <!-- Slick -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css">

    <!-- Existing CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>


<body>


<!-- =========================================================
     TOP HEADER
========================================================= -->

<div class="bg-nex text-white py-1">

    <div class="container">

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-1">


            <!-- Social Icons -->

            <div class="d-flex align-items-center gap-1">

                <a href="{{ $link->whatsApp ?? '#' }}" target="_blank"
                    class="social-icon d-flex align-items-center justify-content-center rounded-circle bg-white text-decoration-none"
                    style="width:22px;height:22px;color:#25D366!important;">

                    <i class="bi bi-whatsapp" style="font-size:12px;"></i>

                </a>


                <a href="{{ $link->facebook}}" target="_blank"
                 
                    class="social-icon d-flex align-items-center justify-content-center rounded-circle bg-white text-decoration-none"
                    style="width:22px;height:22px;color:#1877F2!important;">

                    <i class="bi bi-facebook" style="font-size:12px;"></i>
                     
                </a>


                <a href="{{ $link->youtube ?? '#' }}" target="_blank"
                    class="social-icon d-flex align-items-center justify-content-center rounded-circle bg-white text-decoration-none"
                    style="width:22px;height:22px;color:#FF0000!important;">

                    <i class="bi bi-youtube" style="font-size:12px;"></i>

                </a>


                <a href="{{ $link->linkedin ?? '#' }}" target="_blank"
                    class="social-icon d-flex align-items-center justify-content-center rounded-circle bg-white text-decoration-none"
                    style="width:22px;height:22px;color:#0A66C2!important;">

                    <i class="bi bi-linkedin" style="font-size:12px;"></i>

                </a>


                <a href="{{ $link->email  }}" target="_blank"
                    class="social-icon d-flex align-items-center text-decoration-none">

                    <span class="d-flex align-items-center justify-content-center rounded-circle bg-white"
                        style="width:22px;height:22px;color:#EA4335;">

                        <i class="bi bi-envelope-fill" style="font-size:12px;"></i>

                    </span>

                </a>

            </div>


            <!-- Phone + Account -->

            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-end gap-2">

                <a href="tel:    {{ $link->phone ?? '#' }}" target="_blank"
                    class="text-white text-decoration-none small">

                    <i class="bi bi-telephone-fill me-1"></i>

                

                </a>


                <span class="d-none d-md-inline">|</span>


                <div class="dropdown">

                    @auth

                        <a href="#"
                            class="text-white text-decoration-none dropdown-toggle small"
                            data-bs-toggle="dropdown">

                            <i class="bi bi-person-fill me-1"></i>

                            {{ Auth::user()->name }}

                        </a>


                        <ul class="dropdown-menu dropdown-menu-end">

                            <li>

                                <a class="dropdown-item"
                                    href="{{ route('dashboard') }}">

                                    <i class="bi bi-speedometer2 me-2"></i>

                                    Dashboard

                                </a>

                            </li>


                            <li>

                                <a class="dropdown-item"
                                    href="{{ route('orders.page') }}">

                                    <i class="bi bi-bag-check me-2"></i>

                                    Order

                                </a>

                            </li>


                            <li>

                                <a class="dropdown-item"
                                    href="{{ route('settings') }}">

                                    <i class="bi bi-gear me-2"></i>

                                    Settings

                                </a>

                            </li>


                            <li>

                                <hr class="dropdown-divider">

                            </li>


                            <li>

                                <form method="POST"
                                    action="{{ route('logout') }}">

                                    @csrf

                                    <button type="submit"
                                        class="dropdown-item">

                                        <i class="bi bi-box-arrow-right me-2"></i>

                                        Logout

                                    </button>

                                </form>

                            </li>

                        </ul>


                    @else


                        <a href="#"
                            class="text-white text-decoration-none dropdown-toggle small"
                            data-bs-toggle="dropdown">

                            <i class="bi bi-person-fill me-1"></i>

                            My Account

                        </a>


                        <ul class="dropdown-menu dropdown-menu-end">

                            <li>

                                <a class="dropdown-item"
                                    href="{{ route('login') }}">

                                    <i class="bi bi-person me-2"></i>

                                    Login

                                </a>

                            </li>


                            <li>

                                <a class="dropdown-item"
                                    href="{{ route('register') }}">

                                    <i class="bi bi-bag me-2"></i>

                                    Register

                                </a>

                            </li>

                        </ul>


                    @endauth

                </div>

            </div>

        </div>

    </div>

</div>



<!-- =========================================================
     MAIN NAVBAR
========================================================= -->

<nav class="navbar navbar-expand-lg bg-white border-bottom border-1 border-nex py-1 position-sticky top-0 z-1">

    <div class="container align-items-center">


        <!-- Logo -->

        <a class="navbar-brand d-flex align-items-center"
            href="{{ route('home.page') }}">

            <img src="{{ asset('storage/' . $add->logo) }}"
                alt="NexXoom"
                style="width: 200px; height: 30px;"
                class="img-fluid">

        </a>



        <!-- Mobile Cart + Menu -->

        <div class="d-flex d-lg-none align-items-center gap-2">


            <a href="#"
                class="text-nex position-relative text-decoration-none p-1"
                data-bs-toggle="offcanvas"
                data-bs-target="#shoppingCart">

                <i class="bi bi-cart3 fs-5"></i>

                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-nex border border-white cart-count">

                    {{ $cartCount }}

                </span>

            </a>


            <button class="navbar-toggler border border-1 border-nex rounded-2 shadow-none p-1"
                type="button"
                data-bs-toggle="offcanvas"
                data-bs-target="#mobileMenu">

                <i class="bi bi-list fs-5 text-nex"></i>

            </button>

        </div>



        <!-- Navbar Collapse -->

        <div class="collapse navbar-collapse"
            id="navbarTogglerDemo02">


            <!-- Menu -->

            <ul class="navbar-nav mx-auto mb-2 mb-lg-0 align-items-lg-center">

                <li class="nav-item">

                    <a class="nav-link px-3 py-1 fw-medium text-nex"
                        href="{{ route('home.page') }}">

                        Home

                    </a>

                </li>


                <li class="nav-item">

                    <a class="nav-link px-3 py-1 fw-medium text-nex"
                        href="{{ route('newArrivel.page') }}">

                        New Arrivals

                    </a>

                </li>


                <li class="nav-item">

                    <a class="nav-link px-3 py-1 fw-medium text-nex"
                        href="{{ route('bed.page') }}">

                        Bed

                    </a>

                </li>


                <li class="nav-item">

                    <a class="nav-link px-3 py-1 fw-medium text-nex"
                        href="{{ route('sofa.page') }}">

                        Sofa

                    </a>

                </li>


                <li class="nav-item">

                    <a class="nav-link px-3 py-1 fw-medium text-nex"
                        href="{{ route('chair.page') }}">

                        Chair

                    </a>

                </li>


                <li class="nav-item">

                    <a class="nav-link px-3 py-1 fw-medium text-nex"
                        href="{{ route('shop.page') }}">

                        Shop

                    </a>

                </li>


                <li class="nav-item">

                    <a class="nav-link px-3 py-1 fw-medium text-nex"
                        href="{{ route('contact.page') }}">

                        Contact

                    </a>

                </li>

            </ul>



            <!-- =====================================================
                 DESKTOP SEARCH
            ====================================================== -->

            <form class="d-flex me-lg-3 mb-2 mb-lg-0"
                id="productSearchForm">

                <div class="position-relative">

                    <input
                        id="productSearch"
                        class="form-control border border-2 border-nex rounded-pill pe-5"
                        type="search"
                        placeholder="Search..."
                        style="width: 280px; height: 30px;"
                        autocomplete="off">


                    <button
                        class="btn position-absolute top-50 end-0 translate-middle-y border-0 bg-transparent text-nex px-3 shadow-none"
                        type="submit">

                        <i class="bi bi-search"></i>

                    </button>


                    <!-- DESKTOP SEARCH RESULT -->

                    <div
                        id="searchResults"
                        class="position-absolute bg-white border rounded shadow-sm w-100 mt-1"
                        style="z-index:1050;">

                    </div>

                </div>

            </form>



            <!-- Desktop Cart -->

            <a href="#"
                class="ms-lg-1 text-nex position-relative text-decoration-none p-1"
                data-bs-toggle="offcanvas"
                data-bs-target="#shoppingCart">

                <i class="bi bi-cart3 fs-5"></i>

                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger border border-white cart-count">

                    {{ $cartCount }}

                </span>

            </a>

        </div>

    </div>

</nav>



<!-- =========================================================
     MOBILE LEFT OFFCANVAS MENU
========================================================= -->

<div class="offcanvas offcanvas-start"
    tabindex="-1"
    id="mobileMenu">


    <!-- Mobile Menu Header -->

    <div class="offcanvas-header border-bottom border-1 border-nex px-4 py-2">

        <img src="{{ asset('icon and image/logo-2.jpeg') }}"
            alt="NexXoom"
            style="width: 150px; height: 24px;"
            class="img-fluid">


        <button type="button"
            class="btn-close shadow-none"
            data-bs-dismiss="offcanvas">
        </button>

    </div>



    <!-- Mobile Menu Body -->

    <div class="offcanvas-body d-flex flex-column px-4">


        <!-- =====================================================
             MOBILE SEARCH
        ====================================================== -->

        <div class="mb-3">

            <form id="mobileProductSearchForm">

                <div class="input-group">

                    <input
                        type="search"
                        id="mobileProductSearch"
                        class="form-control"
                        placeholder="Search product..."
                        autocomplete="off">


                    <button
                        type="submit"
                        class="btn bg-nex text-white">

                        <i class="bi bi-search"></i>

                    </button>

                </div>

            </form>


            <!-- Mobile Search Results -->

            <div
                id="mobileSearchResults"
                class="bg-white border rounded shadow-sm mt-1">

            </div>

        </div>



        <!-- =====================================================
             MOBILE MENU LINKS
        ====================================================== -->

        <ul class="navbar-nav">


                <li class="nav-item">

                    <a class="nav-link px-3 py-1 fw-medium text-nex"
                        href="{{ route('home.page') }}">

                        Home

                    </a>

                </li>


                <li class="nav-item">

                    <a class="nav-link px-3 py-1 fw-medium text-nex"
                        href="{{ route('newArrivel.page') }}">

                        New Arrivals

                    </a>

                </li>


                <li class="nav-item">

                    <a class="nav-link px-3 py-1 fw-medium text-nex"
                        href="{{ route('bed.page') }}">

                        Bed

                    </a>

                </li>


                <li class="nav-item">

                    <a class="nav-link px-3 py-1 fw-medium text-nex"
                        href="{{ route('sofa.page') }}">

                        Sofa

                    </a>

                </li>


                <li class="nav-item">

                    <a class="nav-link px-3 py-1 fw-medium text-nex"
                        href="{{ route('chair.page') }}">

                        Chair

                    </a>

                </li>


                <li class="nav-item">

                    <a class="nav-link px-3 py-1 fw-medium text-nex"
                        href="{{ route('shop.page') }}">

                        Shop

                    </a>

                </li>


                <li class="nav-item">

                    <a class="nav-link px-3 py-1 fw-medium text-nex"
                        href="{{ route('contact.page') }}">

                        Contact

                    </a>

                </li>


        </ul>

    </div>

</div>



<!-- =========================================================
     SHOPPING CART OFFCANVAS
========================================================= -->

<div class="offcanvas offcanvas-end"
    tabindex="-1"
    id="shoppingCart">


    <div class="offcanvas-header border-bottom px-4 py-2">

        <h6 class="offcanvas-title fw-semibold text-uppercase mb-0">

            Shopping Cart

        </h6>


        <button type="button"
            class="btn border-0 shadow-none p-0 d-flex align-items-center gap-1 mx-auto"
            data-bs-dismiss="offcanvas">

            <span>Close</span>

            <i class="bi bi-arrow-right fs-5"></i>

        </button>

    </div>



    <div class="offcanvas-body p-0 d-flex flex-column">


        <div class="flex-grow-1 overflow-auto px-3 pt-4">


            @forelse($cart as $item)


                <div class="card border rounded-3 shadow-sm mb-3">

                    <div class="card-body p-2">

                        <div class="d-flex align-items-center gap-2">


                            <div class="border rounded-3 d-flex align-items-center justify-content-center flex-shrink-0"
                                style="width:54px;height:54px;">

                                <img src="{{ asset('storage/' . $item['photo']) }}"
                                    alt=""
                                    class="img-fluid rounded"
                                    style="max-height:48px;">

                            </div>


                            <div class="flex-grow-1">


                                <div class="fw-semibold text-dark mb-1 text-truncate">

                                    {{ $item['name'] }}

                                </div>


                                <div class="d-flex align-items-center gap-2">


                                    <button type="button"
                                        class="btn btn-light rounded-circle p-1 qty-btn"
                                        data-id="{{ $item['id'] }}"
                                        data-action="dec">

                                        <i class="bi bi-dash"></i>

                                    </button>


                                    <span class="px-2 qty-value"
                                        id="offcanvas-qty-{{ $item['id'] }}">

                                        {{ $item['quantity'] }}

                                    </span>


                                    <button type="button"
                                        class="btn btn-light rounded-circle p-1 qty-btn"
                                        data-id="{{ $item['id'] }}"
                                        data-action="inc">

                                        <i class="bi bi-plus"></i>

                                    </button>


                                    <span class="item-total-{{ $item['id'] }}">

                                        ৳{{ $item['quantity'] * $item['price'] }}

                                    </span>

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

                    <p class="text-muted mt-2 mb-0">

                        Your cart is empty

                    </p>

                </div>


            @endforelse


        </div>



        <!-- Cart Total -->

        <div class="bg-light border-top">


            <div class="px-3 py-2 border-top">

                <div class="d-flex align-items-center justify-content-between">

                    <span class="fw-medium">

                        Total:

                    </span>


                    <span class="fw-bold fs-5"
                        id="cart-grand-total">

                        ৳{{ number_format($cartTotal, 2) }}

                    </span>

                </div>

            </div>


            <div class="px-3 pb-3">

                <a href="{{ route('checkout.page') }}"
                    class="btn bg-xoom hover:bg-nex text-white fw-semibold text-uppercase w-100 py-2">

                    Checkout

                </a>

            </div>

        </div>

    </div>

</div>



<!-- =========================================================
     FLOATING CART
========================================================= -->

<a href="#"
    class="position-fixed top-50 end-0 translate-middle-y text-decoration-none shadow overflow-hidden rounded-start-2 z-3"
    data-bs-toggle="offcanvas"
    data-bs-target="#shoppingCart">


    <div class="bg-xoom text-white text-center px-2 py-2">

        <i class="bi bi-bag fs-4 d-block lh-1 mb-1"></i>


        <span class="small fw-semibold text-nowrap">

            <span class="floating-cart-count">

                {{ $cartCount }}

            </span>

            Items

        </span>

    </div>


    <div class="bg-white text-xoom text-center px-1 py-1">

        <span class="small fw-semibold text-nowrap floating-cart-price">

            ৳{{ number_format($cartTotal, 2) }}

        </span>

    </div>

</a>



<!-- Bootstrap JS -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>


@include('alart.message')



<!-- DESKTOP PRODUCT LIVE SEAR-->

<script>

document.addEventListener('DOMContentLoaded', function () {


    const searchInput =
        document.getElementById('productSearch');

    const searchForm =
        document.getElementById('productSearchForm');

    const searchResults =
        document.getElementById('searchResults');


    if (!searchInput || !searchForm || !searchResults) {
        return;
    }


    searchForm.addEventListener('submit', function (e) {

        e.preventDefault();

    });


    searchInput.addEventListener('input', function () {


        const search =
            this.value.trim();


        if (search.length === 0) {

            searchResults.innerHTML = '';

            return;

        }


        fetch(
            `{{ route('product.live.search') }}?search=${encodeURIComponent(search)}`
        )


        .then(function (response) {

            return response.json();

        })


        .then(function (products) {


            searchResults.innerHTML = '';


            if (products.length === 0) {

                searchResults.innerHTML = `

                    <div class="p-2 text-muted small">

                        No product found

                    </div>

                `;

                return;

            }


            products.forEach(function (product) {


                searchResults.innerHTML += `

                    <a
                        href="{{ url('product/details') }}/${product.id}"
                        class="d-block text-decoration-none text-dark border-bottom p-2">

                        <div class="fw-semibold">

                            ${product.title}

                        </div>

                        <small class="text-success">

                            ৳${product.price}

                        </small>

                    </a>

                `;

            });


        })


        .catch(function (error) {

            console.error(
                'Live Search Error:',
                error
            );

        });


    });


    document.addEventListener('click', function (e) {


        if (!searchForm.contains(e.target)) {

            searchResults.innerHTML = '';

        }


    });


});

</script>



<!-- MOBILE PRODUCT LIVE SEARCH -->

<script>

document.addEventListener('DOMContentLoaded', function () {


    const mobileSearchInput =
        document.getElementById('mobileProductSearch');


    const mobileSearchForm =
        document.getElementById('mobileProductSearchForm');


    const mobileSearchResults =
        document.getElementById('mobileSearchResults');


    if (
        !mobileSearchInput ||
        !mobileSearchForm ||
        !mobileSearchResults
    ) {

        return;

    }




    mobileSearchForm.addEventListener('submit', function (e) {

        e.preventDefault();

    });




    mobileSearchInput.addEventListener('input', function () {


        const search =
            this.value.trim();




        if (search.length === 0) {

            mobileSearchResults.innerHTML = '';

            return;

        }




        fetch(
            `{{ route('product.live.search') }}?search=${encodeURIComponent(search)}`
        )


        .then(function (response) {

            return response.json();

        })


        .then(function (products) {


            mobileSearchResults.innerHTML = '';



        
            if (products.length === 0) {

                mobileSearchResults.innerHTML = `

                    <div class="p-2 text-muted small">

                        No product found

                    </div>

                `;

                return;

            }




            products.forEach(function (product) {


                mobileSearchResults.innerHTML += `

                    <a
                        href="{{ url('product/details') }}/${product.id}"
                        class="d-block text-decoration-none text-dark border-bottom p-2">

                        <div class="fw-semibold">

                            ${product.title}

                        </div>


                        <small class="text-success">

                            ৳${product.price}

                        </small>

                    </a>

                `;


            });


        })


        .catch(function (error) {

            console.error(
                'Mobile Live Search Error:',
                error
            );

        });


    });


});

</script>



<!--GLOBAL CART AJAX -->

<script>

(function () {


    const CSRF = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute('content');


    const UPDATE_URL =
        "{{ route('cart.quantity.update') }}";


    function syncAll(productId, data) {


        // Offcanvas quantity

        const offQty =
            document.getElementById(
                'offcanvas-qty-' + productId
            );


        if (offQty) {

            offQty.innerText =
                data.quantity;

        }



        // Checkout quantity

        const coQty =
            document.getElementById(
                'qty-' + productId
            );


        if (coQty) {

            coQty.innerText =
                data.quantity;

        }



        // Item total

        document
            .querySelectorAll(
                '.item-total-' + productId
            )
            .forEach(function (el) {

                el.innerText =
                    '৳' + data.itemTotal;

            });



        // Offcanvas grand total

        const gt =
            document.getElementById(
                'cart-grand-total'
            );


        if (gt) {

            gt.innerText =
                '৳' +
                Number(data.cartTotal).toFixed(2);

        }



        // Checkout subtotal

        const sub =
            document.getElementById(
                'subtotalDisplay'
            );


        if (sub) {

            sub.innerText =
                data.cartTotal;

        }



        // Checkout item count

        const cnt =
            document.getElementById(
                'itemCount'
            );


        if (cnt) {

            cnt.innerText =
                data.cartCount;

        }



        // Checkout total

        const tot =
            document.getElementById(
                'totalDisplay'
            );


        const shippingEl =
            document.getElementById(
                'shippingDisplay'
            );


        const shipping =
            shippingEl
                ? Number(shippingEl.innerText)
                : 150;


        if (tot) {

            tot.innerText =
                shipping +
                Number(data.cartTotal);

        }



        // All cart count badges

        document
            .querySelectorAll('.cart-count')
            .forEach(function (el) {

                el.innerText =
                    data.cartCount;

            });



        // Floating cart count

        const fcc =
            document.querySelector(
                '.floating-cart-count'
            );


        if (fcc) {

            fcc.innerText =
                data.cartCount;

        }



        // Floating cart price

        const fcp =
            document.querySelector(
                '.floating-cart-price'
            );


        if (fcp) {

            fcp.innerText =
                '৳' +
                Number(data.cartTotal).toFixed(2);

        }

    }



    /*
    |--------------------------------------------------------------------------
    | Quantity Buttons
    |--------------------------------------------------------------------------
    */

    document.addEventListener('click', function (e) {


        const btn =
            e.target.closest('.qty-btn');


        if (!btn) {

            return;

        }


        e.preventDefault();


        const productId =
            btn.dataset.id;


        const action =
            btn.dataset.action;


        if (btn.disabled) {

            return;

        }


        btn.disabled = true;



        fetch(UPDATE_URL, {

            method: 'POST',

            headers: {

                'Content-Type': 'application/json',

                'X-CSRF-TOKEN': CSRF,

                'Accept': 'application/json'

            },


            body: JSON.stringify({

                product_id: productId,

                action: action

            })

        })


        .then(function (response) {

            return response.json();

        })


        .then(function (data) {


            btn.disabled = false;


            if (!data.success) {

                alert(
                    data.message ||
                    'Update failed'
                );

                return;

            }


            syncAll(
                data.productId ||
                productId,
                data
            );


        })


        .catch(function (error) {


            btn.disabled = false;


            console.error(error);


            alert(
                'Something went wrong'
            );


        });


    });


})();

</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>