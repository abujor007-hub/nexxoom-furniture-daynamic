<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Profile Settings</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>

    <div class="container py-4">

        {{-- Success Messages --}}
        @if (session('status') === 'profile-updated')
            <div class="alert alert-success">
                <i class="bi bi-check-circle me-2"></i>
                Profile updated successfully.
            </div>
        @endif

        @if (session('status') === 'password-updated')
            <div class="alert alert-success">
                <i class="bi bi-check-circle me-2"></i>
                Password changed successfully.
            </div>
        @endif


        {{-- Update Profile --}}
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body p-4">

                <h4 class="mb-4">
                    <i class="bi bi-person-circle me-2"></i>
                    Update Profile
                </h4>

                <form method="POST" action="{{ route('settings.profile.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Name</label>

                        <input
                            type="text"
                            name="name"
                            class="form-control"
                            value="{{ old('name', $user->name) }}"
                        >

                        @error('name')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>


                    <div class="mb-3">
                        <label class="form-label">Email</label>

                        <input
                            type="email"
                            name="email"
                            class="form-control"
                            value="{{ old('email', $user->email) }}"
                        >

                        @error('email')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i>
                        Save
                    </button>

                </form>

            </div>
        </div>


        {{-- Change Password --}}
        <div class="card shadow-sm border-0">

            <div class="card-body p-4">

                <h4 class="mb-4">
                    <i class="bi bi-shield-lock me-2"></i>
                    Change Password
                </h4>

                <form method="POST" action="{{ route('settings.password.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">
                            Current Password
                        </label>

                        <input
                            type="password"
                            name="current_password"
                            class="form-control"
                        >

                        @error('current_password')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>


                    <div class="mb-3">
                        <label class="form-label">
                            New Password
                        </label>

                        <input
                            type="password"
                            name="password"
                            class="form-control"
                        >

                        @error('password')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>


                    <div class="mb-3">
                        <label class="form-label">
                            Confirm New Password
                        </label>

                        <input
                            type="password"
                            name="password_confirmation"
                            class="form-control"
                        >
                    </div>


                    <button type="submit" class="btn btn-warning">
                        <i class="bi bi-key me-1"></i>
                        Change Password
                    </button>

                </form>

            </div>
        </div>

    </div>


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>