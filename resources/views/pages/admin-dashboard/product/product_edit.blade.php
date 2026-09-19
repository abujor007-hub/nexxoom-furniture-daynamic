@extends('pages.layout.layout')

@section('content')
    <div class="container bg-white py-4">

        <!-- Header -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">

            <div>
                <h3 class="fw-bold mb-1">
                    <i class="bi bi-box-seam-fill me-2"></i>
                    Edit Product
                </h3>

                <p class="text-muted mb-0">
                    Update the product information below
                </p>
            </div>

            <a href="{{ route('product.list') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i>
                Back to Products
            </a>

        </div>


        <!-- Edit Product Form -->
        <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">

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

                <!-- Product Title -->
                <div class="col-12 col-md-8">
                    <label class="form-label fw-semibold">
                        Product Title
                    </label>

                    <input
                        type="text"
                        name="title"
                        class="form-control form-control-lg"
                        placeholder="Enter product title"
                        value="{{ old('title', $product->title) }}"
                        required>
                </div>


                <!-- Category -->
                <div class="col-12 col-md-4">

                    <label class="form-label fw-semibold">
                        Category
                    </label>

                    <select name="category" class="form-select form-select-lg" required>

                        <option value="" disabled>
                            Select Category
                        </option>

                        @foreach ($category as $item)

                            <option
                                value="{{ $item->category }}"
                                {{ old('category', $product->category) == $item->category ? 'selected' : '' }}>

                                {{ $item->category }}

                            </option>

                        @endforeach

                    </select>

                </div>


                <!-- Description -->
                <div class="col-12">

                    <label class="form-label fw-semibold">
                        Description
                    </label>

                    <textarea
                        name="description"
                        class="form-control"
                        rows="4"
                        placeholder="Write a short description about the product">{{ old('description', $product->description) }}</textarea>

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

                        <input
                            type="number"
                            name="price"
                            class="form-control"
                            placeholder="0.00"
                            step="0.01"
                            min="0"
                            value="{{ old('price', $product->price) }}"
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

                        <input
                            type="number"
                            name="discount_price"
                            class="form-control"
                            placeholder="0.00"
                            step="0.01"
                            min="0"
                            value="{{ old('discount_price', $product->discount_price) }}">

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

                        <input
                            type="number"
                            name="quantity"
                            class="form-control"
                            placeholder="Enter quantity"
                            min="0"
                            step="1"
                            value="{{ old('quantity', $product->quantity) }}"
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

                    <select name="status" class="form-select form-select-lg" required>

                        <option value="" disabled>
                            Select Status
                        </option>

                        <option
                            value="active"
                            {{ old('status', $product->status) == 'active' ? 'selected' : '' }}>
                            Active
                        </option>

                        <option
                            value="inactive"
                            {{ old('status', $product->status) == 'inactive' ? 'selected' : '' }}>
                            Inactive
                        </option>

                        <option
                            value="out_of_stock"
                            {{ old('status', $product->status) == 'out_of_stock' ? 'selected' : '' }}>
                            Out of Stock
                        </option>

                        <option
                            value="draft"
                            {{ old('status', $product->status) == 'draft' ? 'selected' : '' }}>
                            Draft
                        </option>

                    </select>

                </div>

            </div>



            <!-- Section: Media -->
            <div class="border-bottom pb-2 mb-4">

                <h5 class="fw-semibold text-primary">
                    <i class="bi bi-image-fill me-2"></i>
                    Product Image
                </h5>

            </div>


            <div class="row g-4 mb-5">

                <div class="col-12 col-md-6">

                    <!-- Current / Preview Image -->

                    @if ($product->image)

                        <img
                            id="prevImage"
                            src="{{ asset('storage/' . $product->image) }}"
                            alt="{{ $product->title }}"
                            width="200"
                            height="200"
                            class="rounded border mb-2"
                            style="object-fit:cover;">

                    @else

                        <img
                            id="prevImage"
                            src=""
                            alt="Product"
                            width="200"
                            height="200"
                            class="rounded border mb-2"
                            style="object-fit:cover;">

                    @endif

                    <br>


                    <label for="image" class="form-label fw-semibold">
                        Upload New Image
                    </label>

                    <input
                        type="file"
                        name="image"
                        id="image"
                        class="form-control form-control-lg"
                        accept="image/*"
                        oninput="if(this.files[0]) prevImage.src=window.URL.createObjectURL(this.files[0])">


                    <div class="form-text">
                        Leave empty to keep the current image.
                    </div>

                </div>

            </div>



            <!-- Actions -->
            <div class="d-flex justify-content-end gap-2 border-top pt-4">

                <a
                    href="{{ route('product.list') }}"
                    class="btn btn-outline-secondary btn-lg px-4">

                    <i class="bi bi-x-circle me-1"></i>
                    Cancel

                </a>


                <button
                    type="submit"
                    class="btn btn-primary btn-lg px-4">

                    <i class="bi bi-check-circle-fill me-1"></i>
                    Update Product

                </button>

            </div>

        </form>

    </div>
@endsection