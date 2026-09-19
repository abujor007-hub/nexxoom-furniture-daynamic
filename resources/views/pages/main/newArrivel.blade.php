@include('commonsection.nav')

  <!-- new arivel start -->

<div class="container mt-2">

    <!-- HEADER -->
    <div class="d-flex align-items-center justify-content-center mb-4 px-2 px-sm-0">
        <h2 class="text-nex fw-bold border-bottom border-2 border-nex pb-1 mb-0">
            New Arrival
        </h2>
    </div>


    <!-- PRODUCT GRID -->
    <div class="py-4">

        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-5 g-3 g-md-4 g-lg-5">

            @foreach ($data['new_arrival'] as $items)



                <!-- PRODUCT 1 -->
                <div class="col">
                    <div class="card h-100 shadow-sm border-0 hover-lift">

                        <a href="{{ route('product.details',$items->id) }}">

                        <img src="{{ asset('storage/' . $items->image) }}" class="card-img-top p-2" alt="Product 5"
                            style="object-fit:contain; height:160px; background:#f8f9fa;">
                            </a>

                        <div class="card-body p-2 p-md-3 text-nex">

                            <h6 class="fw-semibold mb-1">
                                {{ $items->title }}
                            </h6>

                            <div class="fw-bold text-xoom">
                                $100
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
   
</div>

@include('commonsection.footer')