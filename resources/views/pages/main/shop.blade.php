@include('commonsection.nav')

 <div class="container py-4 mt-4">

        <ul class="nav nav-pills justify-content-center border-bottom mb-2" id="furnitureTabs" role="tablist">

            <li class="nav-item mb-2" role="presentation">
                <button class="nav-link active rounded-0 px-4 py-1" data-bs-toggle="pill" data-bs-target="#sofa"
                    type="button">
                    Sofa
                </button>
            </li>

            <li class="nav-item mb-2" role="presentation">
                <button class="nav-link rounded-0 px-4 py-1" data-bs-toggle="pill" data-bs-target="#table"
                    type="button">
                    Table
                </button>
            </li>

            <li class="nav-item mb-2" role="presentation">
                <button class="nav-link rounded-0 px-4 py-1" data-bs-toggle="pill" data-bs-target="#chair"
                    type="button">
                    Chair
                </button>
            </li>

            <li class="nav-item mb-2" role="presentation">
                <button class="nav-link rounded-0 px-4 py-1" data-bs-toggle="pill" data-bs-target="#bed" type="button">
                    Bed
                </button>
            </li>

            <li class="nav-item mb-2" role="presentation">
                <button class="nav-link rounded-0 px-4 py-1" data-bs-toggle="pill" data-bs-target="#lightning"
                    type="button">
                    Lightning
                </button>
            </li>

          

        </ul>


        <!-- ================================================= -->
        <!-- TAB CONTENT -->
        <!-- ================================================= -->

        <div class="tab-content">


            <!-- ================================================= -->
            <!-- SOFA -->
            <!-- ================================================= -->

            <div class="tab-pane fade show active" id="sofa">

                <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4">

                   @foreach ($data['Sofa'] as $items)
                    
                  
                    <!-- CARD 1 -->
                    <div class="col">

                        <div class="border bg-white text-center h-100">

                            <div class="ratio ratio-4x3">
                                <a href="{{ route('product.details',$items->id) }}">

                                <img src="{{  asset('storage/' . $items->image) }}"
                                    class="img-fluid object-fit-contain p-2" alt="Sofa">
                                    </a>

                            </div>

                            <div class="p-3">

                                <h6 class="lh-base mb-3 text-nex">
                                    {{ $items->title }}
                                </h6>

                                <h5 class="fw-bold text-danger text-xoom">
                                    ${{ $items->price }}
                                </h5>

                            </div>

                        </div>

                    </div>
                     @endforeach


                </div>

            </div>


            <!-- ================================================= -->
            <!-- TABLE -->
            <!-- ================================================= -->

            <div class="tab-pane fade" id="table">

                <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4">

                     @foreach ($data['Table'] as $items)
                        
                  
                    <!-- CARD 1 -->
                    <div class="col">

                        <div class="border bg-white text-center h-100">

                            <div class="ratio ratio-4x3">
                                 <a href="{{ route('product.details',$items->id) }}">

                                <img src="{{  asset('storage/' . $items->image) }}"
                                    class="img-fluid object-fit-contain p-2" alt="Table">
                                    </a>

                            </div>

                            <div class="p-3">

                                <h6 class="lh-base mb-3 text-nex">
                                    {{ $items->title }}
                                </h6>

                                <h5 class="fw-bold text-danger text-xoom">
                                    ${{ $items->price }}
                                </h5>

                            </div>

                        </div>

                    </div>
                       @endforeach



                </div>

            </div>


            <!-- ================================================= -->
            <!-- CHAIR -->
            <!-- ================================================= -->

            <div class="tab-pane fade" id="chair">

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

                                <h5 class="fw-bold text-xoom">
                                    ${{ $items->price }}
                                </h5>

                            </div>

                        </div>

                    </div>
                       @endforeach

                </div>

            </div>


            <!-- ================================================= -->
            <!-- BED -->
            <!-- ================================================= -->

            <div class="tab-pane fade" id="bed">

                <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4">


                   @foreach ($data['Bed'] as $items)
                        
                 
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

                                <h6 class="lh-base mb-3  text-nex">
                                    {{ $items->title }}
                                </h6>

                                <h5 class="fw-bold text-xoom">
                                    ${{ $items->price }}
                                </h5>

                            </div>

                        </div>

                    </div>
                       @endforeach


                  
                </div>

            </div>


            <!-- ================================================= -->
            <!-- LIGHTNING -->
            <!-- ================================================= -->

            <div class="tab-pane fade" id="lightning">

                <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4">

  @foreach ($data['Light'] as $items)
                        
                 
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

                                <h5 class="fw-bold text-xoom">
                                    ${{ $items->price }}
                                </h5>

                            </div>

                        </div>

                    </div>
                       @endforeach

                  

                </div>

            </div>


            <!-- ================================================= -->
            <!-- DECORE -->
            <!-- ================================================= -->

           
        </div>

    </div>

<!-- best saller start  -->
<div class="container py-5">


    @foreach ($data['Best_Seller'] as $items)



        <!-- Slick Slider -->
        <div id="product-slider">

            <div class="px-2">
                <div class="card border-0">
                    <div class="ratio ratio-1x1 bg-warning-subtle">
                        <a href="{{ route('product.details',$items->id) }}">
                        <img src=" {{ asset('storage/' . $items->image) }}" class="object-fit-cover" alt="Orange chair">
                        </a>
                    </div>
                    <div class="card-body px-0 pt-3">
                        <h6 class="fw-bold text-nex mb-1">{{ $items->title }}</h6>
                        <p class="text-xoom mb-0">{{ $items->price }}</p>
                    </div>
                </div>
            </div>
    @endforeach
    </div>
    <div class="d-flex justify-content-center mt-2 ">
        {{ $data['new_arrival']->links() }}
    </div>
</div>
<!-- best saller end  -->


<div class="container mt-2">


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
    <div class="d-flex justify-content-center mt-2 ">
        {{ $data['new_arrival']->links() }}
    </div>
</div>




<!-- shop by room start  -->





    <div class="container mt-5">

        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-5 g-3 g-md-4 mt-4">


            <!-- ================= IMAGE 1 ================= -->
            @foreach ($data['Shop_By_Room'] as $items)
                
          
            <div class="col">

                <div class="ratio ratio-1x1 overflow-hidden ">
                    <a href="{{ route('product.details',$items->id) }}">

                    <img src="{{ asset('storage/' . $items->image) }}" alt="Shop By Room 1" class="w-100 h-100"
                        style="object-fit: cover;">
                        </a>

                </div>

            </div>
              @endforeach


        </div>
          <div class="d-flex justify-content-center mt-2 ">
        {{ $data['new_arrival']->links() }}
    </div>

    </div>

    <!-- shop by room end -->





    <section class="py-5 ">
        <div class="container">


            <!-- Slick Slider -->
            <div class="product-slider">

                @foreach ($data['Our_Favorute_Category'] as $items )
                    
              

                <!-- Item 1 -->
                <div class="px-2">
                    <div class="text-center">
                        <div class="bg-light d-flex align-items-center justify-content-center mb-3"
                            style="height:300px;">
                            <a href="{{ route('product.details',$items->id) }}">
                            <img src="{{ asset('storage/' . $items->image) }}" class="img-fluid" style="max-height:260px;"
                                alt="Modern Chair">
                                </a>
                        </div>
                        <h5 class="fw-normal mb-1">{{ $items->title }}</h5>
                        <p class="mb-0">
                            <span class="text-decoration-line-through text-muted me-2">${{ $items->discount_price }}</span>
                            <span>${{ $items->price }}</span>
                        </p>
                    </div>
                </div>
                  @endforeach

             
                        <!-- /Slick Slider -->

            </div>
            
    </section>




    <!-- populer start  -->
    <div class="container mt-2">
 
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-5 g-4 mt-4 justify-content-center populer-image">
         @foreach ($data['Populer_Category'] as $items)
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
          <div class="d-flex justify-content-center mt-4 ">
        {{ $data['new_arrival']->links() }}
    </div>
    </div>
    <!-- populer end -->

<!-- tranding items start  -->


<div class="container mt-5">




    <!-- PRODUCT GRID -->
    <div class="py-4">

        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-5 g-3 g-md-4 g-lg-5">

            @foreach ($data['Trandings_Items'] as $items)
                
          
            <!-- PRODUCT 6 -->
            <div class="col">
                <div class="card h-100 shadow-sm border-0">
                     <a href="{{ route('product.details',$items->id) }}">

                    <img src="{{ asset('storage/' . $items->image) }}" class="card-img-top p-2" alt="Product 4"
                        style="object-fit:contain; height:160px; background:#f8f9fa;">
                        </a>

                    <div class="card-body p-2 p-md-3">

                        <h6 class="fw-semibold text-nex mb-1">
                            {{ $items->title }}
                        </h6>

                        <div class="fw-bold text-xoom">
                            {{ $items->price }}
                        </div>

                    </div>
                </div>
            </div>
              @endforeach

        </div>
    </div>
      <div class="d-flex justify-content-center mt-2 ">
        {{ $data['new_arrival']->links() }}
    </div>
</div>


<!-- tranding items end -->

    @include('commonsection.footer')