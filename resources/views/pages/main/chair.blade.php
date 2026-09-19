@include('commonsection.nav')

 <div class="container mt-2">
        <div class="d-flex align-items-center justify-content-center mb-4 px-2 px-sm-0">
            <h2 class="text-nex fw-bold border-bottom border-2 border-nex pb-1 mb-0">
            Our Chair Collection
            </h2>
        </div>

              

                <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4">

                    @foreach ($data['Chair'] as $items)
                        
                 
                    <!-- CARD 1 -->
                    <div class="col">

                        <div class="border bg-white text-center h-100">

                            <div class="ratio ratio-4x3">

                                <a href="{{ route('product.details',$items->id) }}">

                                <img src="{{  asset('storage/' . $items->image) }}"
                                    class="img-fluid object-fit-contain p-2" alt="Chair">
                                    </a>

                            </div>

                            <div class="p-3">

                                <h6 class="lh-base mb-3 text-nex">
                                    {{ $items->title }}
                                </h6>

                                <h5 class="fw-bold text-danger">
                                    ${{ $items->price }}
                                </h5>

                            </div>

                        </div>

                    </div>
                       @endforeach

                </div>

            </div>



       
        
    </div>
@include('commonsection.footer')