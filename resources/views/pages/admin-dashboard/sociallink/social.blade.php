@extends('pages.layout.layout')

@section('content')

<div class="container py-4">

    <div class="card shadow-sm border-0">

        <div class="card-header bg-white py-3 text-center ">
            <h5 class="fw-bold mb-0">
                <i class="bi bi-share me-2"></i>
                Social Media Links
            </h5>
        </div>

        <div class="card-body p-4">

         
            <form action="{{ route('store.link') }}" method="POST" enctype=" multipart/form-data">

                @csrf
                @method('PUT')

                <div class="row g-4">

                    {{-- Facebook --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-facebook me-2"></i>Facebook
                        </label>

                        <input type="url"
                               name="facebook"
                               class="form-control"
                               placeholder="https://facebook.com/yourpage"
                               value="{{ old('facebook', $socialLink->facebook ?? '') }}">
                    </div>

                    {{-- YouTube --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-youtube me-2"></i>YouTube
                        </label>

                        <input type="url"
                               name="youtube"
                               class="form-control"
                               placeholder="https://youtube.com/@channel"
                               value="{{ old('youtube', $socialLink->youtube ?? '') }}">
                    </div>

                    {{-- Twitter --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-twitter-x me-2"></i>Twitter / X
                        </label>

                        <input type="url"
                               name="twitter"
                               class="form-control"
                               placeholder="https://x.com/username"
                               value="{{ old('twitter', $socialLink->twitter ?? '') }}">
                    </div>

                    {{-- Website --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-globe me-2"></i>Website
                        </label>

                        <input type="url"
                               name="webSite"
                               class="form-control"
                               placeholder="https://example.com"
                               value="{{ old('webSite', $socialLink->webSite ?? '') }}">
                    </div>

                    {{-- GitHub --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-github me-2"></i>GitHub
                        </label>

                        <input type="url"
                               name="github"
                               class="form-control"
                               placeholder="https://github.com/username"
                               value="{{ old('github', $socialLink->github ?? '') }}">
                    </div>

                    {{-- WhatsApp --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-whatsapp me-2"></i>WhatsApp
                        </label>

                        <input type="text"
                               name="whatsApp"
                               class="form-control"
                               placeholder="+8801XXXXXXXXX"
                               value="{{ old('whatsApp', $socialLink->whatsApp ?? '') }}">
                    </div>

                    {{-- LinkedIn --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-linkedin me-2"></i>LinkedIn
                        </label>

                        <input type="url"
                               name="linkedin"
                               class="form-control"
                               placeholder="https://linkedin.com/in/username"
                               value="{{ old('linkedin', $socialLink->linkedin ?? '') }}">
                    </div>

                    {{-- Gmail --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-envelope me-2"></i>Gmail
                        </label>

                        <input type="email"
                               name="gmail"
                               class="form-control"
                               placeholder="example@gmail.com"
                               value="{{ old('gmail', $socialLink->gmail ?? '') }}">
                    </div>

                </div>

                {{-- Submit Button --}}
                <div class="mt-4 text-end">

                    <button type="submit" class="btn btn-primary px-4">

                        <i class="bi bi-save me-2"></i>
                        Submit

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection