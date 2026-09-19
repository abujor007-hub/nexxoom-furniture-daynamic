@extends('pages.layout.layout')
@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>User Dashboard</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>

    <div class="container-fluid py-4">
        <div class="row">

            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 mb-4">
                <div class="bg-dark text-white rounded p-3">

                    <div class="text-center mb-4">
                        <i class="bi bi-person-circle" style="font-size: 3rem;"></i>

                        <h6 class="mt-2 mb-0">
                            {{ $user->name }}
                        </h6>

                        <small class="text-white-50">
                            {{ ucfirst($user->user_type) }}
                        </small>
                    </div>

                    <ul class="nav flex-column">

                        <li class="nav-item mb-1">
                            <a href="{{ route('dashboard') }}"
                               class="nav-link text-white active bg-secondary rounded">

                                <i class="bi bi-speedometer2 me-2"></i>
                                Dashboard

                            </a>
                        </li>

                        <li class="nav-item mb-1">
                            <a href="{{ route('settings') }}"
                               class="nav-link text-white">

                                <i class="bi bi-gear me-2"></i>
                                Settings

                            </a>
                        </li>

                        <li class="nav-item mb-1">

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <button type="submit"
                                        class="nav-link text-white border-0 bg-transparent w-100 text-start">

                                    <i class="bi bi-box-arrow-right me-2"></i>
                                    Logout

                                </button>
                            </form>

                        </li>

                    </ul>

                </div>
            </div>


            <!-- Main Content -->
            <div class="col-md-9 col-lg-10">

                <!-- Page Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">

                    <div>
                        <h4 class="mb-0">
                            Dashboard
                        </h4>

                        <small class="text-muted">
                            Welcome back, {{ $user->name }} 👋
                        </small>
                    </div>

                    <div>
                        <a href="{{ route('settings') }}"
                           class="btn btn-outline-dark btn-sm">

                            <i class="bi bi-gear me-1"></i>
                            Settings

                        </a>
                    </div>

                </div>


                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif


                <!-- Stat Cards -->
                <div class="row g-3 mb-4">

                    <!-- Account Type -->
                    <div class="col-md-4">

                        <div class="card shadow-sm border-0">

                            <div class="card-body d-flex align-items-center">

                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3"
                                     style="width:50px;height:50px;">

                                    <i class="bi bi-person"></i>

                                </div>

                                <div>

                                    <h6 class="mb-0">
                                        Account Type
                                    </h6>

                                    <p class="text-muted mb-0 small">
                                        {{ ucfirst($user->user_type) }}
                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>


                    <!-- Email -->
                    <div class="col-md-4">

                        <div class="card shadow-sm border-0">

                            <div class="card-body d-flex align-items-center">

                                <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-3"
                                     style="width:50px;height:50px;">

                                    <i class="bi bi-envelope"></i>

                                </div>

                                <div>

                                    <h6 class="mb-0">
                                        Email
                                    </h6>

                                    <p class="text-muted mb-0 small">
                                        {{ $user->email }}
                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>


                    <!-- Joined -->
                    <div class="col-md-4">

                        <div class="card shadow-sm border-0">

                            <div class="card-body d-flex align-items-center">

                                <div class="bg-warning text-white rounded-circle d-flex align-items-center justify-content-center me-3"
                                     style="width:50px;height:50px;">

                                    <i class="bi bi-calendar-check"></i>

                                </div>

                                <div>

                                    <h6 class="mb-0">
                                        Joined
                                    </h6>

                                    <p class="text-muted mb-0 small">
                                        {{ $user->created_at->format('d M, Y') }}
                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                <!-- Account Information -->
                <div class="card shadow-sm border-0">

                    <div class="card-header bg-white">

                        <h6 class="mb-0">
                            Account Information
                        </h6>

                    </div>

                    <div class="card-body">

                        <table class="table table-borderless mb-0">

                            <tr>
                                <th style="width: 200px;">
                                    Name
                                </th>

                                <td>
                                    {{ $user->name }}
                                </td>
                            </tr>

                            <tr>
                                <th>
                                    Email
                                </th>

                                <td>
                                    {{ $user->email }}
                                </td>
                            </tr>

                            <tr>
                                <th>
                                    Email Verified
                                </th>

                                <td>

                                    @if ($user->email_verified_at)

                                        <span class="badge bg-success">
                                            Verified
                                        </span>

                                    @else

                                        <span class="badge bg-danger">
                                            Not Verified
                                        </span>

                                    @endif

                                </td>
                            </tr>

                            <tr>
                                <th>
                                    User Type
                                </th>

                                <td>
                                    {{ ucfirst($user->user_type) }}
                                </td>
                            </tr>

                            <tr>
                                <th>
                                    Member Since
                                </th>

                                <td>
                                    {{ $user->created_at->format('d M, Y - h:i A') }}
                                </td>
                            </tr>

                        </table>

                    </div>

                </div>

            </div>

        </div>
    </div>


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
@endsection