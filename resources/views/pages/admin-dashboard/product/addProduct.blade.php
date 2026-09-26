@extends('pages.layout.layout')

@section('content')
    <div class="container bg-white py-4">

        <!-- Header -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">

            <div>
                <h3 class="fw-bold mb-1">
                    <i class="bi bi-box-seam-fill me-2"></i>
                    Add Product
                </h3>

                <p class="text-muted mb-0">
                    Fill in the details below to add a new product
                </p>
            </div>

            <a href="" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i>
                Back to Products
            </a>

        </div>


        <!-- Add Product Form -->
        <form action="{{ route('product.store') }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf
            @method('PUT')


            <!-- Section: Basic Info -->
            <div class="border-bottom pb-2 mb-4">
                <h5 class="fw-semibold text-primary">
                    <i class="bi bi-info-circle-fill me-2"></i>
                    Basic Information
                </h5>
            </div>


            <div class="row g-4 mb-5">

                <div class="col-12 col-md-8">

                    <label class="form-label fw-semibold">
                        Product Title
                    </label>

                    <input type="text"
                           name="title"
                           class="form-control form-control-lg"
                           placeholder="Enter product title"
                           value="{{ old('title') }}"
                           required>

                </div>


                <div class="col-12 col-md-4">

                    <label class="form-label fw-semibold">
                        Category
                    </label>

                    <select name="category"
                            class="form-select form-select-lg"
                            required>

                        <option value="" selected disabled>
                            Select Category
                        </option>

                        @foreach ($category as $item)

                            <option value="{{ $item->category }}"
                                {{ old('category') == $item->category ? 'selected' : '' }}>

                                {{ $item->category }}

                            </option>

                        @endforeach

                    </select>

                </div>


                <div class="col-12">

                    <label class="form-label fw-semibold">
                        Description
                    </label>

                    <textarea name="description"
                              class="form-control"
                              rows="4"
                              placeholder="Write a short description about the product">{{ old('description') }}</textarea>

                </div>

            </div>


            <!-- Section: Pricing -->
            <div class="border-bottom pb-2 mb-4">

                <h5 class="fw-semibold text-primary">
                    <i class="bi bi-tag-fill me-2"></i>
                    Pricing
                </h5>

            </div>


            <div class="row g-4 mb-5">


                <!-- Price -->
                <div class="col-12 col-md-4">

                    <label class="form-label fw-semibold">
                        Price
                    </label>

                    <div class="input-group input-group-lg">

                        <span class="input-group-text">
                            ৳
                        </span>

                        <input type="number"
                               name="price"
                               class="form-control"
                               placeholder="0.00"
                               step="0.01"
                               min="0"
                               value="{{ old('price') }}"
                               required>

                    </div>

                </div>


                <!-- Discount Price -->
                <div class="col-12 col-md-4">

                    <label class="form-label fw-semibold">
                        Discount Price
                    </label>

                    <div class="input-group input-group-lg">

                        <span class="input-group-text">
                            ৳
                        </span>

                        <input type="number"
                               name="discount_price"
                               class="form-control"
                               placeholder="0.00"
                               step="0.01"
                               min="0"
                               value="{{ old('discount_price') }}">

                    </div>

                </div>


                <!-- Quantity -->
                <div class="col-12 col-md-4">

                    <label class="form-label fw-semibold">
                        Quantity
                    </label>

                    <div class="input-group input-group-lg">

                        <span class="input-group-text">
                            <i class="bi bi-boxes"></i>
                        </span>

                        <input type="number"
                               name="quantity"
                               class="form-control"
                               placeholder="Enter quantity"
                               min="0"
                               step="1"
                               value="{{ old('quantity') }}"
                               required>

                    </div>

                    <div class="form-text">
                        Enter available product quantity.
                    </div>

                </div>


                <!-- Status -->
                <div class="col-12 col-md-4">

                    <label class="form-label fw-semibold">
                        Status
                    </label>

                    <select name="status"
                            class="form-select form-select-lg"
                            required>

                        <option value="" selected disabled>
                            Select Status
                        </option>

                        <option value="active"
                            {{ old('status') == 'active' ? 'selected' : '' }}>
                            Active
                        </option>

                        <option value="inactive"
                            {{ old('status') == 'inactive' ? 'selected' : '' }}>
                            Inactive
                        </option>

                        <option value="out_of_stock"
                            {{ old('status') == 'out_of_stock' ? 'selected' : '' }}>
                            Out of Stock
                        </option>

                        <option value="draft"
                            {{ old('status') == 'draft' ? 'selected' : '' }}>
                            Draft
                        </option>

                    </select>

                </div>

            </div>


            <!-- Section: Media -->
            <div class="border-bottom pb-2 mb-4">

                <h5 class="fw-semibold text-primary">
                    <i class="bi bi-image-fill me-2"></i>
                    Product Images
                </h5>

            </div>


            <div class="row g-4 mb-5">


                <!-- Main Product Image -->
                <div class="col-12 col-md-6">

                    <h6 class="fw-semibold">
                        Main Product Image
                    </h6>

                    <img id="prevImage"
                         src=""
                         alt="Product"
                         width="200"
                         height="200"
                         class="rounded border mb-2"
                         style="object-fit:cover;">

                    <br>

                    <label for="image"
                           class="form-label fw-semibold">

                        Upload Main Image

                    </label>

                    <input type="file"
                           id="image"
                           name="image"
                           class="form-control form-control-lg"
                           accept="image/*"
                           onchange="previewMainImage(this)"
                           required>

                    <div class="form-text">
                        Recommended size: 800x800px, JPG or PNG.
                    </div>

                </div>


                <!-- Multiple Images -->
                <div class="col-12 col-md-6">

                    <h6 class="fw-semibold">
                        Multiple Product Images
                    </h6>

                    <div class="mb-3">

                        <label for="multiple_images"
                               class="form-label fw-semibold">

                            Upload Multiple Images

                        </label>

                        <input type="file"
                               id="multiple_images"
                               name="multiple_images[]"
                               class="form-control form-control-lg"
                               accept="image/*"
                               multiple
                               onchange="previewMultipleImages(this)">

                    </div>


                    <div class="form-text mb-3">
                        You can select multiple images at once.
                        JPG, JPEG, PNG or WEBP.
                    </div>


                    <!-- Multiple Image Preview -->
                    <div id="multipleImagePreview"
                         class="row g-2">

                    </div>

                </div>

            </div>


            <!-- Actions -->
            <div class="d-flex justify-content-end gap-2 border-top pt-4">

                <button type="reset"
                        class="btn btn-outline-secondary btn-lg px-4">

                    <i class="bi bi-arrow-counterclockwise me-1"></i>

                    Reset

                </button>


                <button type="submit"
                        class="btn btn-primary btn-lg px-4">

                    <i class="bi bi-check-circle-fill me-1"></i>

                    Save Product

                </button>

            </div>


        </form>

    </div>


    <!-- JavaScript -->
    <script>

        // Main Image Preview
        function previewMainImage(input) {

            if (input.files && input.files[0]) {

                const reader = new FileReader();

                reader.onload = function(e) {

                    document.getElementById('prevImage').src = e.target.result;

                };

                reader.readAsDataURL(input.files[0]);

            }

        }


        // Multiple Images Preview
        function previewMultipleImages(input) {

            const preview = document.getElementById('multipleImagePreview');

            preview.innerHTML = '';


            if (input.files) {

                Array.from(input.files).forEach(function(file) {

                    const reader = new FileReader();

                    reader.onload = function(e) {

                        const div = document.createElement('div');

                        div.className = 'col-6 col-sm-4 col-md-3';


                        div.innerHTML = `
                            <img src="${e.target.result}"
                                 class="img-thumbnail w-100"
                                 style="height:120px; object-fit:cover;">
                        `;

                        preview.appendChild(div);

                    };

                    reader.readAsDataURL(file);

                });

            }

        }

    </script>

@endsection