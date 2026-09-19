@include('commonsection.nav')


<!-- Product Details Section -->

<div class="container my-5">

    <div class="row g-4">


        <!-- LEFT: PRODUCT IMAGE -->

        <div class="col-lg-5 col-md-6 col-sm-12">

            <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded border" alt="Product Image">

        </div>



        <!-- RIGHT: PRODUCT INFORMATION -->

        <div class="col-lg-7 col-md-6 col-sm-12">


            <!-- Product Title -->

            <h2 class="fw-bold">

                {{ $product->title }}

            </h2>



            <!-- Price -->

            <h3 class="text-success">

                ৳{{ $product->price }}


                <small class="text-muted text-decoration-line-through fs-6">

                    ৳{{ $product->discount_price }}

                </small>


                <span class="badge bg-danger ms-2">

                    25% OFF

                </span>

            </h3>



            <!-- Description -->

            <p class="mt-3">

                {{ $product->description }}

            </p>



            <!-- STATUS -->

            <h5 class="mb-3">

                <span class="text-muted">

                    Status:

                </span>


                @if ($product->status == 'active')

                    <span class="badge text-bg-success">

                        {{ $product->status }}

                    </span>


                @elseif ($product->status == 'inactive')

                    <span class="badge text-bg-secondary">

                        {{ $product->status }}

                    </span>


                @elseif ($product->status == 'pending')

                    <span class="badge text-bg-warning">

                        {{ $product->status }}

                    </span>


                @elseif ($product->status == 'out_of_stock')

                    <span class="badge text-bg-danger">

                        {{ $product->status }}

                    </span>


                @else

                    <span class="badge text-bg-primary">

                        {{ $product->status }}

                    </span>

                @endif

            </h5>






            <!-- QUANTITY -->
            {{-- <div class="d-flex align-items-center gap-3">

                <label class="mb-0">
                    Quantity:
                </label>


                <div class="d-flex align-items-center gap-2">
                    <button type="button" class="btn btn-light rounded-circle p-1 qty-btn" data-id="{{ $product->id }}"
                        data-action="dec">
                        <i class="bi bi-dash"></i>
                    </button>
                    <span class="px-2 qty-value" id="qty-{{ $product->id }}">{{ $product->quantity }}</span>
                    <button type="button" class="btn btn-light rounded-circle p-1 qty-btn" data-id="{{ $product->id }}"
                        data-action="inc">
                        <i class="bi bi-plus"></i>
                    </button>
                  
                </div>
            </div> --}}


            <!-- ACTION BUTTONS -->

            <div class="div mt-3 d-flex gap-5">


                <form action="{{ route('addtocart.store', $product->id) }}" method="GET" class="d-flex gap-5">


                    @csrf


                    <!-- SELECTED QUANTITY -->

                    <input type="hidden" name="quantity" id="selectedQuantity-{{ $product->id }}" value="1">



                    <!-- ADD TO CART -->

                    <button type="submit" name="action" value="cart" class="btn btn-primary">

                        Add to Cart

                    </button>



                    <!-- BUY NOW -->

          <button class="btn btn-success" name="action" value="byenow" type="submit">
    Bye Now
</button>


                </form>
                <div>
                  
                </div>


            </div>


        </div>

    </div>



    <!-- DESCRIPTION SECTION -->

    <div class="mt-5">

        <h4 class="fw-bold mb-3">

            Description

        </h4>


        <ul class="list-group list-group-flush">


            <li class="list-group-item">

                Lightweight mesh upper for maximum breathability

            </li>


            <li class="list-group-item">

                Cushioned insole for all-day comfort

            </li>


            <li class="list-group-item">

                Durable rubber outsole with anti-slip grip

            </li>


            <li class="list-group-item">

                Flexible design that adapts to natural foot movement

            </li>


            <li class="list-group-item">

                Reinforced heel support for extra stability

            </li>


            <li class="list-group-item">

                Suitable for running, jogging, gym, and casual wear

            </li>


            <li class="list-group-item">

                Available in multiple sizes and colors

            </li>


            <li class="list-group-item">

                Machine washable and easy to maintain

            </li>


        </ul>

    </div>



    <!-- RELATED PRODUCTS -->

    <div class="mt-5">

        <h4 class="fw-bold mb-3">

            Related Products

        </h4>


        <div class="row g-4">


            <!-- Product 1 -->

            <div class="col-lg-3 col-md-4 col-sm-6">

                <div class="card h-100">

                    <img src="https://via.placeholder.com/300x200?text=Shoe+1" class="card-img-top"
                        alt="Related product">


                    <div class="card-body">

                        <h6 class="card-title">

                            Trail Runner Pro

                        </h6>


                        <p class="text-success mb-0">

                            $64.99

                        </p>

                    </div>

                </div>

            </div>



            <!-- Product 2 -->

            <div class="col-lg-3 col-md-4 col-sm-6">

                <div class="card h-100">

                    <img src="https://via.placeholder.com/300x200?text=Shoe+2" class="card-img-top"
                        alt="Related product">


                    <div class="card-body">

                        <h6 class="card-title">

                            UltraLite Sneaker

                        </h6>


                        <p class="text-success mb-0">

                            $54.99

                        </p>

                    </div>

                </div>

            </div>



            <!-- Product 3 -->

            <div class="col-lg-3 col-md-4 col-sm-6">

                <div class="card h-100">

                    <img src="https://via.placeholder.com/300x200?text=Shoe+3" class="card-img-top"
                        alt="Related product">


                    <div class="card-body">

                        <h6 class="card-title">

                            Sport Flex

                        </h6>


                        <p class="text-success mb-0">

                            $49.99

                        </p>

                    </div>

                </div>

            </div>



            <!-- Product 4 -->

            <div class="col-lg-3 col-md-4 col-sm-6">

                <div class="card h-100">

                    <img src="https://via.placeholder.com/300x200?text=Shoe+4" class="card-img-top"
                        alt="Related product">


                    <div class="card-body">

                        <h6 class="card-title">

                            City Walker

                        </h6>


                        <p class="text-success mb-0">

                            $44.99

                        </p>

                    </div>

                </div>

            </div>


        </div>

    </div>


</div>



<!-- PRODUCT DETAILS QUANTITY SCRIPT -->

{{-- <script>
    document.addEventListener('DOMContentLoaded', function () {


        const buttons =
            document.querySelectorAll(
                '.product-qty-btn'
            );


        const quantityElement =
            document.getElementById(
                'product-quantity'
            );


        const hiddenInput =
            document.getElementById(
                'selectedQuantity'
            );


        buttons.forEach(function (button) {


            button.addEventListener(
                'click',
                function () {


                    const action =
                        this.dataset.action;


                    let quantity =
                        parseInt(
                            quantityElement.innerText
                        );


                    /*
                    |--------------------------------------------------------------------------
                    | PLUS
                    |--------------------------------------------------------------------------
                    */

                    if (action === 'inc') {

                        quantity++;
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | MINUS
                    |--------------------------------------------------------------------------
                    */

                    if (
                        action === 'dec' &&
                        quantity > 1
                    ) {

                        quantity--;
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | Update Screen
                    |--------------------------------------------------------------------------
                    */

                    quantityElement.innerText =
                        quantity;


                    /*
                    |--------------------------------------------------------------------------
                    | Update Hidden Input
                    |--------------------------------------------------------------------------
                    */

                    hiddenInput.value =
                        quantity;

                }
            );

        });

    });
</script> --}}

@include('commonsection.footer')