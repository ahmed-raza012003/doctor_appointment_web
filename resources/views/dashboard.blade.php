<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Precision Health and Dentistry</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('build/admin/images/logos/logo.png') }}" />
    <link rel="stylesheet" href="{{ asset('build/admin/css/styles.min.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        @include('partials.sidebar')
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            @include('partials.header')
            <!--  Header End -->
            <div class="container-fluid">
                @yield('content')
                <div class="py-6 px-6 text-center">
                    <p class="mb-0 fs-4">Design and Developed by <a href="https://hhtechhub.com" target="_blank" class="pe-1 text-primary text-decoration-underline">HH Tech Hub</a></p>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('build/admin/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('build/admin/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('build/admin/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('build/admin/js/app.min.js') }}"></script>
    <script src="{{ asset('build/admin/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="{{ asset('build/admin/libs/simplebar/dist/simplebar.js') }}"></script>
    <script src="{{ asset('build/admin/js/dashboard.js') }}"></script>
</body>

</html>