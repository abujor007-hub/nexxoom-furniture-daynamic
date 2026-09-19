@extends('pages.layout.layout')

@section('content')

<div class="container py-4">

    <div class="card shadow-sm">

        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">
                <i class="bi bi-cloud-upload"></i>
                Upload Ads & Logo
            </h5>
        </div>

        <div class="card-body">

   

            <form action="{{ route('store.add.logo') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf
                @method('PUT')

                {{-- Ads Image --}}
                <div class="mb-3">

                    <label class="form-label fw-bold">
                        Ads Image
                    </label>

                    <input
                        type="file"
                        name="addImage"
                        class="form-control"
                        accept="image/*"
                    >

                </div>

                {{-- Logo --}}
                <div class="mb-3">

                    <label class="form-label fw-bold">
                        Website Logo
                    </label>

                    <input
                        type="file"
                        name="logo"
                        class="form-control"
                        accept="image/*"
                    >

                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-upload"></i>
                    Upload
                </button>

            </form>

        </div>

    </div>

</div>

@endsection