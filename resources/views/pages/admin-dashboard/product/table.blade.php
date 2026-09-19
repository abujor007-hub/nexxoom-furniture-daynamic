@extends('pages.layout.layout')
@section('content')
    <div class="container-fluid bg-white py-4">

        <!-- Product List -->
        <div class="border-bottom pb-2 mb-4">
            <h5 class="fw-semibold text-primary">
                <i class="bi bi-list-ul me-2"></i>
                Table Product List
            </h5>
        </div>

        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead class="table-light">
                    <tr>
                        <th class="px-2">#</th>
                        <th>Product</th>
                        <th>Image</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Discount</th>
                        <th>Quantity</th>
                        <th>Status</th>
                        <th class="text-end px-2">Action</th>
                    </tr>
                </thead>

                <tbody>

                    @php
                        $i = 1;
                    @endphp

                    @foreach ($product as $product)
                        <tr>
                            <td class="px-2 fw-semibold">{{ $i++ }}</td>
                            <td>{{ $product->title }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="Product" width="48" height="48"
                                        class="rounded border" style="object-fit:cover;">
                                    <span class="fw-semibold">{{ $product->title }}</span>
                                </div>
                            </td>
                            <td>{{ $product->category }}</td>
                            <td>৳{{ number_format($product->price, 2) }}</td>
                            <td>৳{{ number_format($product->discount_price, 2) }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td>
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
                            </td>
                            <td class="text-end px-2">
                                <div class="d-flex justify-content-end gap-2">

                                    <!-- Edit -->
                                    <a href="{{ route('product.edit', $product->id) }}" class="btn btn-outline-primary btn-sm">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <!-- Delete -->
                                    <!-- Delete Button -->
<form action="{{ route('product.delete',$product->id) }}" method="POST" class="d-inline">

    @csrf
    @method('DELETE')

    <button type="button"
            class="btn btn-outline-danger btn-sm"
            data-bs-toggle="modal"
            data-bs-target="#deleteModal{{ $product->id }}">

        <i class="bi bi-trash3"></i>

    </button>

</form>


<!-- Delete Modal -->
<div class="modal fade"
     id="deleteModal{{ $product->id }}"
     tabindex="-1"
     aria-labelledby="deleteModalLabel{{ $product->id }}"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content border-0 shadow">

            <!-- Header -->
            <div class="modal-header">

                <h5 class="modal-title fw-bold"
                    id="deleteModalLabel{{ $product->id }}">

                    <i class="bi bi-exclamation-triangle-fill text-danger me-2"></i>
                    Delete Product

                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close">
                </button>

            </div>


            <!-- Body -->
            <div class="modal-body text-center py-4">

                <i class="bi bi-trash3 text-danger"
                   style="font-size: 45px;">
                </i>

                <h5 class="mt-3 fw-bold">
                    Are you sure?
                </h5>

                <p class="text-muted mb-0">

                    You want to delete
                    <strong>{{ $product->name }}</strong>?

                    <br>

                    This action cannot be undone.

                </p>

            </div>


            <!-- Footer -->
            <div class="modal-footer justify-content-center">

                <!-- Cancel -->
                <button type="button"
                        class="btn btn-secondary px-4"
                        data-bs-dismiss="modal">

                    Cancel

                </button>


                <!-- Delete -->
                <form action="{{ route('product.delete',$product->id) }}"
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

                                </div>
                            </td>

                     

                    @endforeach
                           @php
                                $i++;
                            @endphp






                </tbody>

            </table>

        </div>

    </div>

@endsection