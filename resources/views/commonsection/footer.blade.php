<!-- fotter start -->
<footer class="bg-white border-top mt-5 text-nex">

    <div class="container py-5">

        <div class="row gy-4 row-cols-1 row-cols-md-2 row-cols-lg-4">

            <!-- ================= ABOUT US ================= -->
            <div class="col">

                <h5 class="fw-bold text-uppercase mb-3">
                    About Us
                </h5>

                <!-- Logo -->
                <div style="width: 200px; height: 30px;">
                    <a class="navbar-brand d-block w-100 h-100" href="index.html">
                        <img src="{{ asset('storage/' . $add->logo) }}" alt="NexXoom" class="img-fluid"
                            style="width: 100%; height: 100%; ">
                    </a>
                </div>

                <!-- Description -->
                <p class="mt-2 mb-3 hover:text-xoom">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                    Voluptatem ipsum natus nam? Perspiciatis, assumenda.
                </p>

                <!-- Social Icons -->
                <div class="d-flex align-items-center gap-2 flex-wrap">

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

                <a href="tel:    {{ $link->phone ?? '#' }}"
                    class="text-white text-decoration-none small">

                    <i class="bi bi-telephone-fill me-1"></i>

                

                </a>

                </div>

            </div>


            <!-- ================= PRODUCT ================= -->
            <div class="col">

                <h5 class="fw-bold text-uppercase mb-3">
                    Product
                </h5>

                <ul class="list-unstyled mb-0">

                    <li class="mb-2">
                        <a href="#" class="text-decoration-none text-nex hover:text-xoom">
                            Furniture
                        </a>
                    </li>

                    <li class="mb-2">
                        <a href="#" class="text-decoration-none text-nex hover:text-xoom">
                            Sofa
                        </a>
                    </li>

                    <li class="mb-2">
                        <a href="#" class="text-decoration-none text-nex hover:text-xoom">
                            Bed
                        </a>
                    </li>

                    <li class="mb-2">
                        <a href="#" class="text-decoration-none text-nex hover:text-xoom">
                            Others
                        </a>
                    </li>

                </ul>

            </div>


            <!-- ================= PAGES ================= -->
            <div class="col">

                <h5 class="fw-bold text-uppercase mb-3">
                    Pages
                </h5>

                <ul class="list-unstyled mb-0">

                    <li class="mb-2">
                        <a href="#" class="text-decoration-none text-nex hover:text-xoom">
                            Home
                        </a>
                    </li>

                    <li class="mb-2">
                        <a href="#" class="text-decoration-none text-nex hover:text-xoom">
                            New Arrival
                        </a>
                    </li>

                    <li class="mb-2">
                        <a href="#" class="text-decoration-none text-nex hover:text-xoom">
                            Shop
                        </a>
                    </li>

                    <li class="mb-2">
                        <a href="#" class="text-decoration-none text-nex hover:text-xoom">
                            Contact
                        </a>
                    </li>

                </ul>

            </div>


            <!-- ================= CONTACT ================= -->
            <div class="col">

                <h5 class="fw-bold text-uppercase mb-3">
                    Contact Us
                </h5>

                <ul class="list-unstyled mb-0">

                    <li class="mb-2 hover:text-xoom">
                        <i class="bi bi-geo-alt me-2"></i>
                        Dhaka, Bangladesh
                    </li>

                    <li class="mb-2 hover:text-xoom">
                        <i class="bi bi-envelope me-2"></i>
                        nexxoom99@gmail.com
                    </li>

                    <li class="mb-2 hover:text-xoom">
                        <i class="bi bi-telephone me-2"></i>
                        +880 1712 345678
                    </li>

                    <li class="mb-2 hover:text-xoom">
                        <i class="bi bi-printer me-2"></i>
                        +880 1712 345678
                    </li>

                </ul>

            </div>

        </div>

    </div>


    <!-- ================= PAYMENT METHODS ================= -->

    <div class="pay border-top py-3">

        <div class="container text-center">

            <img src="icon and image/payment.png" alt="Payment Methods" class="img-fluid mx-auto d-block" style="
                    max-width: 100%;
                    width: auto;
                    height: 40px;
                    object-fit: contain;
                 ">

        </div>

    </div>


</footer>

<!-- fotter end -->

<footer class="text-center bg-nex d-flex align-items-center justify-content-center text-white" style="height: 30px;">
    <p class="mb-0" style="font-size: 13px;">
        © 2026 Copyrights by
        <strong class="border-bottom border-2">NexXoom</strong>
        All Rights Reserved by
        <strong class="border-bottom border-2">NexXoom</strong>
    </p>
</footer>

<!-- ================= MOBILE BOTTOM NAVBAR ================= -->
<!-- ================= MOBILE BOTTOM NAVBAR ================= -->
<!-- ================= MOBILE BOTTOM NAVBAR ================= -->
<nav class="navbar bg-nex d-lg-none fixed-bottom p-0 shadow-lg">

    <div class="container-fluid p-0">

        <div class="row w-100 g-0 m-0 text-center">

            <!-- HOME -->
            <div class="col px-0">
                <a href="{{ route('home.page') }}"
                    class="text-white text-decoration-none d-flex flex-column align-items-center justify-content-center py-2 w-100">

                    <i class="bi bi-house fs-5 lh-1"></i>

                    <small class="fw-medium mt-1">
                        HOME
                    </small>

                </a>
            </div>


            <!-- MENU -->
            <div class="col px-0">
                <a href="#" id="q5sxom" data-bs-toggle="offcanvas" data-bs-target="#mobileMenu"
                    aria-controls="mobileMenu"
                    class="text-white text-decoration-none d-flex flex-column align-items-center justify-content-center py-2 w-100">

                    <i class="bi bi-grid-3x3-gap fs-5 lh-1"></i>

                    <small class="fw-medium mt-1">
                        MENU
                    </small>

                </a>
            </div>


            <!-- CART -->
            <div class="col px-0">
                <a href="#" id="ikfps0" data-bs-toggle="offcanvas" data-bs-target="#shoppingCart"
                    aria-controls="shoppingCart"
                    class="text-white text-decoration-none d-flex flex-column align-items-center justify-content-center py-2 w-100">

                    <div class="position-relative">

                        <i class="bi bi-bag fs-5 lh-1"></i>

                        <!-- Cart Count -->
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-dark"
                            style="font-size: 9px;">
                            0
                        </span>

                    </div>

                    <small class="fw-medium mt-1">
                        CART
                    </small>

                </a>
            </div>


            <!-- SHOP -->
            <div class="col px-0">
                <a href="{{ route('shop.page') }}"
                    class="text-white text-decoration-none d-flex flex-column align-items-center justify-content-center py-2 w-100">

                    <i class="bi bi-shop fs-5 lh-1"></i>

                    <small class="fw-medium mt-1">
                        SHOP
                    </small>

                </a>
            </div>


            <!-- ACCOUNT -->
            <div class="col px-0">
                <a href="{{ route('dashboard') }}"
                    class="text-white text-decoration-none d-flex flex-column align-items-center justify-content-center py-2 w-100">

                    <i class="bi bi-person fs-5 lh-1"></i>

                    <small class="fw-medium mt-1">
                        ACCOUNT
                    </small>

                </a>
            </div>

        </div>

    </div>

</nav>
<!-- ================= END MOBILE BOTTOM NAVBAR ================= -->
<!-- ================= BACK TO TOP BUTTON ================= -->
<!-- BACK TO TOP -->
<div id="backToTopWrapper" class="position-fixed bottom-0 end-0  me-3 d-none">

    <svg class="position-absolute top-0 start-0" width="52" height="52" viewBox="0 0 52 52">

        <circle cx="26" cy="26" r="23" fill="none" class="scroll-bg">
        </circle>

        <circle id="scrollProgress" cx="26" cy="26" r="23" fill="none" class="scroll-border">
        </circle>

    </svg>

    <button type="button" id="backToTop" class="btn bg-xoom hover:bg-nex text-white rounded-circle shadow">

        <i class="bi bi-arrow-up fs-5"></i>

    </button>

</div>


<!-- WhatsApp Floating Button -->
<a href="https://wa.me/8801712345678"
   target="_blank"
   class="position-fixed mx-4 start-0 bg-xoom text-white rounded-circle shadow d-flex align-items-center justify-content-center text-decoration-none whatsapp-btn">

    <i class="fa-brands fa-whatsapp fs-3"></i>

</a>



<!-- ================= END BACK TO TOP ================= -->
<!-- Bootstrap JS -->
<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
<!-- jquary link start  -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<!-- jquary link end -->
<!-- slick js link start  -->
<link rel="stylesheet" href="{{ asset('cs/style.css') }}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"
    integrity="sha512-HGOnQO9+SP1V92SrtZfjqxxtLmVzqZpjFFekvzZVWoiASSQgSr4cw9Kqd2+l8Llp4Gm0G8GIFJ4ddwZilcdb8A=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- slick js link end -->


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

<script src="{{ asset('js/script.js') }}"></script>

</body>

</html>