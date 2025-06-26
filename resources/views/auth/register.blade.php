<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Precision Health and Dentistry - Register</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('build/admin/images/logos/favicon.png') }}" />
    <link rel="stylesheet" href="{{ asset('build/admin/css/styles.min.css') }}">
</head>
<body>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        <div class="position-relative overflow-hidden min-vh-100 d-flex align-items-center justify-content-center" style="background: radial-gradient(circle at center, #11849B 0%, #0f6d81 100%);">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    <div class="col-md-8 col-lg-6 col-xxl-3">
                        <div class="card mb-0 border-0 shadow-sm">
                            <div class="card-body">
                                <a href="/" class="text-nowrap logo-img text-center d-block py-3 w-100">
                                    <img src="{{ asset('build/admin/images/logos/logo.png') }}" width="180" alt="Logo">
                                </a>
                                <p class="text-center ">Create Your Account</p>
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required autofocus>
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email Address</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                                        @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                                    </div>
                                    <button type="submit" class="btn w-100 py-8 fs-4 mb-4 rounded-2" style="background-color: #11849B; border-color: #11849B; color: #ffffff;">Sign Up</button>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <p class="fs-4 mb-0 fw-bold ">Already have an account?</p>
                                        <a class="text-primary fw-bold ms-2" href="{{ route('login') }}" style="color: #11849B !important;">Sign In</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('build/admin/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('build/admin/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <style>
        .btn:hover {
            background-color: #0f6d81 !important;
            border-color: #0f6d81 !important;
        }
        .card {
            background-color: rgba(255, 255, 255, 0.95);
            border: none;
        }
        .form-control {
            background-color: #f8f9fa;
            border-color: #11849B;
        }
        .form-control:focus {
            border-color: #0f6d81;
            box-shadow: 0 0 0 0.2rem rgba(17, 132, 155, 0.25);
        }
        .text-primary:hover {
            color: #0f6d81 !important;
        }
    </style>
</body>
</html>