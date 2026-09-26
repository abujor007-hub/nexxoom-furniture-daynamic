@include('commonsection.nav')

<!-- ========================================= -->
<!-- SLICK CSS -->
<!-- ========================================= -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css">

<!-- ========================================= -->
<!-- PRODUCT DETAILS -->
<!-- ========================================= -->
<div class="container-fluid bg-white min-vh-100">
    <div class="container py-5">
        <div class="row g-5 align-items-center">

            <!-- ========================================= -->
            <!-- LEFT : PRODUCT IMAGE -->
            <!-- ========================================= -->
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="bg-light rounded-4 position-relative d-flex align-items-center justify-content-center p-4">

                    <!-- Wishlist -->
                    <button type="button" class="btn position-absolute top-0 end-0 m-3 border-0 text-secondary fs-4">
                        <i class="bi bi-heart"></i>
                    </button>

                    <!-- ========================================= -->
                    <!-- IMAGE AREA -->
                    <!-- ========================================= -->
                    <div class="w-100">

                        <!-- ========================================= -->
                        <!-- MAIN IMAGE SLIDER -->
                        <!-- ========================================= -->
                        <div id="productMainSlider">
                            <!-- MAIN PRODUCT IMAGE -->
                            <div>
                                <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded w-100"
                                    alt="{{ $product->title }}" style="height:450px; object-fit:contain;">
                            </div>

                            <!-- ===================================== -->
                            <!-- MULTIPLE PRODUCT IMAGES -->
                            <!-- ===================================== -->
                            @foreach($product->multipleImages as $image)
                                <div>
                                    <img src="{{ asset('storage/' . $image->more_image) }}"
                                        class="img-fluid rounded w-100" alt="{{ $product->title }}"
                                        style="height:450px; object-fit:contain;">
                                </div>
                            @endforeach
                        </div>

                        <!-- ========================================= -->
                        <!-- THUMBNAIL SLIDER -->
                        <!-- ========================================= -->
                        <div id="productThumbnailSlider" class="mt-3">
                            <!-- MAIN IMAGE THUMBNAIL -->
                            <div class="px-1">
                                <img src="{{ asset('storage/' . $product->image) }}" class="img-thumbnail w-100"
                                    alt="{{ $product->title }}" style="height:90px; object-fit:contain;">
                            </div>

                            <!-- ===================================== -->
                            <!-- MULTIPLE IMAGE THUMBNAILS -->
                            <!-- ===================================== -->
                            @foreach($product->multipleImages as $image)
                                <div class="px-1">
                                    <img src="{{ asset('storage/' . $image->more_image) }}"
                                        class="img-thumbnail w-100" alt="{{ $product->title }}"
                                        style="height:90px; object-fit:contain;">
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>

            <!-- ========================================= -->
            <!-- RIGHT : PRODUCT INFORMATION -->
            <!-- ========================================= -->
            <div class="col-lg-6 col-md-6 col-sm-12">

                <!-- Collection -->
                <p class="text-secondary small text-uppercase mb-3">New Collection</p>

                <!-- Product Title -->
                <h1 class="fw-normal display-6 mb-2">{{ $product->title }}</h1>

                <!-- Product Type -->
                <p class="text-secondary fs-5 mb-4">Premium Product</p>

                <!-- ========================================= -->
                <!-- PRICE -->
                <!-- ========================================= -->
                <div class="mb-4">
                    @if($product->discount_price)
                        <span class="text-success fs-2 fw-normal">
                            ৳{{ number_format($product->discount_price, 2) }}
                        </span>
                        <span class="text-muted text-decoration-line-through fs-6 ms-2">
                            ৳{{ number_format($product->price, 2) }}
                        </span>
                        <span class="badge bg-danger ms-2">25% OFF</span>
                    @else
                        <span class="text-success fs-2 fw-normal">
                            ৳{{ number_format($product->price, 2) }}
                        </span>
                    @endif
                </div>

                <!-- ========================================= -->
                <!-- DESCRIPTION -->
                <!-- ========================================= -->
                <div class="mb-4">
                    <p class="text-secondary small text-uppercase mb-2">Description</p>
                    <p class="text-secondary">{{ $product->description }}</p>
                </div>

                <!-- ========================================= -->
                <!-- STATUS -->
                <!-- ========================================= -->
                <div class="mb-3">
                    <span class="text-secondary">Status:</span>
                    @if($product->status == 'active')
                        <span class="badge text-bg-success">{{ $product->status }}</span>
                    @elseif($product->status == 'inactive')
                        <span class="badge text-bg-secondary">{{ $product->status }}</span>
                    @elseif($product->status == 'pending')
                        <span class="badge text-bg-warning">{{ $product->status }}</span>
                    @elseif($product->status == 'out_of_stock')
                        <span class="badge text-bg-danger">{{ $product->status }}</span>
                    @else
                        <span class="badge text-bg-primary">{{ $product->status }}</span>
                    @endif
                </div>

                <!-- ========================================= -->
                <!-- AVAILABLE STOCK -->
                <!-- ========================================= -->
                <div class="mb-4">
                    <span class="text-secondary">Available Stock:</span>
                    @if($product->quantity > 0)
                        <strong>{{ $product->quantity }}</strong>
                    @else
                        <strong class="text-danger">Out of stock</strong>
                    @endif
                </div>

                <!-- ========================================= -->
                <!-- ACTION BUTTONS -->
                <!-- ========================================= -->
                <div class="mt-4">
                    <form action="{{ route('addtocart.store', $product->id) }}" method="GET">
                        <input type="hidden" name="quantity" id="selectedQuantity-{{ $product->id }}" value="1">
                        <div class="d-flex gap-2">
                            <!-- ADD TO CART -->
                            <button type="submit" name="action" value="cart"
                                class="btn btn-outline-primary btn-sm px-3 rounded-pill"
                                {{ $product->quantity < 1 ? 'disabled' : '' }}>
                                <i class="bi bi-cart-plus me-1"></i> Add to Cart
                            </button>
                            <!-- BUY NOW -->
                            <button type="submit" name="action" value="byenow"
                                class="btn btn-success btn-sm px-3 rounded-pill"
                                {{ $product->quantity < 1 ? 'disabled' : '' }}>
                                <i class="bi bi-credit-card me-1"></i> Buy Now
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>

        <!-- ========================================= -->
        <!-- DESCRIPTION SECTION -->
        <!-- ========================================= -->
        <div class="mt-5 pt-4">
            <h4 class="fw-bold mb-3">Description</h4>
            <div class="border-top pt-3">
                <p class="text-secondary mb-0">{{ $product->description }}</p>
            </div>
        </div>

        <!-- ========================================= -->
        <!-- RELATED PRODUCTS -->
        <!-- ========================================= -->
        <div class="mt-5 pt-4">
            <h4 class="fw-bold mb-4">Related Products</h4>
            <div class="row g-4">

                <!-- PRODUCT 1 -->
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="card h-100 border-0 shadow-sm">
                        <img src="https://via.placeholder.com/300x200?text=Shoe+1" class="card-img-top" alt="Related product">
                        <div class="card-body">
                            <h6 class="card-title">Trail Runner Pro</h6>
                            <p class="text-success mb-0">৳64.99</p>
                        </div>
                    </div>
                </div>

                <!-- PRODUCT 2 -->
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="card h-100 border-0 shadow-sm">
                        <img src="https://via.placeholder.com/300x200?text=Shoe+2" class="card-img-top" alt="Related product">
                        <div class="card-body">
                            <h6 class="card-title">UltraLite Sneaker</h6>
                            <p class="text-success mb-0">৳54.99</p>
                        </div>
                    </div>
                </div>

                <!-- PRODUCT 3 -->
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="card h-100 border-0 shadow-sm">
                        <img src="https://via.placeholder.com/300x200?text=Shoe+3" class="card-img-top" alt="Related product">
                        <div class="card-body">
                            <h6 class="card-title">Sport Flex</h6>
                            <p class="text-success mb-0">৳49.99</p>
                        </div>
                    </div>
                </div>

                <!-- PRODUCT 4 -->
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="card h-100 border-0 shadow-sm">
                        <img src="https://via.placeholder.com/300x200?text=Shoe+4" class="card-img-top" alt="Related product">
                        <div class="card-body">
                            <h6 class="card-title">City Walker</h6>
                            <p class="text-success mb-0">৳44.99</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

@include('commonsection.footer')

<!-- ========================================= -->
<!-- JQUERY -->
<!-- ========================================= -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- ========================================= -->
<!-- SLICK JS -->
<!-- ========================================= -->
<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

<!-- ========================================= -->
<!-- SLICK SLIDER -->
<!-- ========================================= -->
<script>
    $(document).ready(function () {

        /* =========================================
           MAIN PRODUCT IMAGE SLIDER
        ========================================= */
        $('#productMainSlider').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: true,
            fade: true,
            asNavFor: '#productThumbnailSlider',
            prevArrow: '<button type="button" class="slick-prev">Previous</button>',
            nextArrow: '<button type="button" class="slick-next">Next</button>'
        });

        /* =========================================
           THUMBNAIL SLIDER
        ========================================= */
        $('#productThumbnailSlider').slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            asNavFor: '#productMainSlider',
            dots: false,
            centerMode: false,
            focusOnSelect: true,
            arrows: true,
            responsive: [
                { breakpoint: 992, settings: { slidesToShow: 4 } },
                { breakpoint: 576, settings: { slidesToShow: 3 } }
            ]
        });

    });
</script>