@include('commonsection.nav')


    <!-- populer start  -->
    <div class="container mt-2">
        <div class="d-flex align-items-center justify-content-center mb-4 px-2 px-sm-0">
            <h2 class="text-nex fw-bold border-bottom border-2 border-nex pb-1 mb-0">
            Our Bed Collection
            </h2>
        </div>


        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-5 g-4 mt-4 justify-content-center populer-image">
         @foreach ($data['Bed'] as $items)
         <a href="">
             <div class="col">
                <div class="h-100 ratio ratio-1x1">
                    <a href="{{ route('product.details',$items->id) }}"> 

                    <img src="{{ asset('storage/' . $items->image) }}" alt="Popular 1" class="img-fluid w-100 h-100"
                        style="object-fit:cover;">
                        </a>
                </div>
            </div>
            </a>
         @endforeach
           

        </div>
        
    </div>
    <!-- bed end -->













@include('commonsection.footer')