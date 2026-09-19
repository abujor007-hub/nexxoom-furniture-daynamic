@extends('pages.layout.layout')

@section('content')
    <div class="container py-4">

        <!-- Header -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">

            <div>
                <h3 class="fw-bold mb-1">
                    <i class="bi bi-grid-fill me-2"></i>
                    Categories
                </h3>

                <p class="text-muted mb-0">
                    Manage your product categories
                </p>
            </div>

        </div>


        <!-- Add Category Card -->
        <div class="card border-0 shadow-sm mb-4">

            <div class="card-header bg-white py-3">
                <h5 class="mb-0 fw-semibold">
                    <i class="bi bi-plus-circle me-2"></i>
                    Add Category
                </h5>
            </div>

            <div class="card-body">


                <form action="{{ route('category.store') }}" method="POST">

                    @csrf
                    @method('PUT')

                    <div class="row g-3 align-items-end">

                        <div class="col-12 col-md-9">

                            <label class="form-label fw-semibold">
                                Category Name
                            </label>

                            <input type="text" name="category" class="form-control" placeholder="Enter category name"
                                required>

                        </div>

                        <div class="col-12 col-md-3">

                            <button type="submit" class="btn btn-primary w-100">
                                <i class="bi bi-plus-lg me-1"></i>
                                Add Category
                            </button>

                        </div>

                    </div>

                </form>

            </div>
        </div>


        <!-- Category Data -->
        <div class="card border-0 shadow-sm">

            <div class="card-header bg-white py-3">

                <div class="d-flex justify-content-between align-items-center">

                    <h5 class="mb-0 fw-semibold">
                        <i class="bi bi-list-ul me-2"></i>
                        Category List
                    </h5>

                    <span class="badge text-bg-primary">

                    </span>

                </div>

            </div>


            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-light">

                            <tr>
                                <th class="px-4">#</th>
                                <th>Category</th>
                                <th class="text-end px-4">Action</th>
                            </tr>

                        </thead>


                        <tbody>

                            @php
                                $i = 1;
                            @endphp

                            @foreach ($category as $item)

                                <tr>

                                    <!-- Serial -->
                                    <td class="px-4 fw-semibold">
                                        {{ $i }}
                                    </td>

                                    <!-- Category -->
                                    <td>
                                        <span class="fw-semibold">
                                            {{ $item->category }}
                                        </span>
                                    </td>

                                    <!-- Delete -->
                                    <td class="text-end px-4">

                                       
<form action="{{ route('category.delete', $item->id) }}" method="POST" class="d-inline">

    @csrf
    @method('DELETE')

    <button type="button"
            class="btn btn-outline-danger btn-sm"
            data-bs-toggle="modal"
            data-bs-target="#deleteModal{{ $item->id }}">

        <i class="bi bi-trash3"></i>

    </button>

</form>


<!-- Delete Modal -->
<div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content border-0 shadow">

            <div class="modal-header">

                <h5 class="modal-title fw-bold">
                    <i class="bi bi-exclamation-triangle-fill text-danger me-2"></i>
                    Delete Category
                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                </button>

            </div>

            <div class="modal-body text-center py-4">

                <i class="bi bi-trash3 text-danger"
                   style="font-size: 45px;"></i>

                <h5 class="mt-3 fw-bold">
                    Are you sure?
                </h5>

                <p class="text-muted mb-0">
                    You want to delete
                    <strong>{{ $item->category }}</strong>?
                    <br>
                    This action cannot be undone.
                </p>

            </div>

            <div class="modal-footer justify-content-center">

                <button type="button"
                        class="btn btn-secondary px-4"
                        data-bs-dismiss="modal">
                    Cancel
                </button>

                <form action="{{ route('category.delete', $item->id) }}"
                      method="POST">

                    @csrf
                    @method('DELETE')

                    <button type="submit"
                            class="btn btn-danger px-4">

                        <i class="bi bi-trash3 me-1"></i>
                        Delete

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>



                                    </td>

                                </tr>

                                @php
                                    $i++;
                                @endphp

                            @endforeach



                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

@endsection