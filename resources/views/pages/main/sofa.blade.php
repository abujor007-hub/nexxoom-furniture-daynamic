@include('commonsection.nav')


<section class="mt-2">
    <div class="container">

        <!-- Heading -->
        <div class="d-flex align-items-center justify-content-center mb-4 px-2 px-sm-0">
            <h2 class="text-nex fw-bold border-bottom border-2 border-nex pb-1 mb-0">
                Our Sofa Collection
            </h2>
        </div>


        <!-- Product Collection -->
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-5 g-3">

@foreach ($data['Sofa'] as $items)
  

            <!-- Item 1 -->
            <div class="col">
                <div class="px-2">
                    <div class="text-center">

                        <div class="bg-light d-flex align-items-center justify-content-center "
                            style="height:240px;">
                            <a href="{{ route('product.details',$items->id) }}">

                            <img src="{{ asset('storage/' . $items->image) }}"
                                class="img-fluid"
                                style="max-height:220px;"
                                alt="Modern Chair">
                                </a>

                        </div>

                        <h5 class="fw-normal text-nex ">
                            {{ $items->title }}
                        </h5>

                        <p class="mb-0">
                            <span class="text-decoration-line-through text-muted me-2">
                                ${{ $items->discount_price }}
                            </span>

                            <span class="text-xoom">
                                ${{ $items->price }}
                            </span>
                        </p>

                    </div>
                </div>
            </div>
            @endforeach



        </div>
        <!-- /Product Collection -->

    </div>
</section>


@include('commonsection.footer')