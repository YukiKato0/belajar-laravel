<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', $title ?? 'Dashboard admin PPKD Sticker')</title>

  <!-- SEO Optimization -->
  <meta name="description" content="Blank Page - Spark Admin Premium Bootstrap 5 Admin Dashboard Template">
  <meta name="author" content="Spark Admin Team">

  <!-- Favicon -->
  <link rel="icon" type="image/png" href="{{ asset("assets/images/favicon.ico") }}">

  <!-- Local Third-Party Libraries (100% Offline Compatible) -->
  <link rel="stylesheet" href="{{ asset("assets/libs/bootstrap/css/bootstrap.min.css") }}">
  <link rel="stylesheet" href="{{ asset("assets/libs/bootstrap-icons/bootstrap-icons.css") }}">
  <link rel="stylesheet" href="{{ asset("assets/libs/apexcharts/apexcharts.css") }}">
  <link rel="stylesheet" href="{{ asset("assets/libs/flatpickr/flatpickr.min.css") }}">

  <!-- Main Design System & Custom Stylesheet -->
  <link rel="stylesheet" href="{{ asset("assets/css/main.css") }}">
</head>

<body>

  <!-- ==========================================
         START: Sidebar Component
         Highly polished, dark-green navigation
         ========================================== -->
  @include('admin.layout.inc.sidebar')
  <!-- ==========================================
         END: Sidebar Component
         ========================================== -->


  <!-- ==========================================
         START: Main Content Area
         ========================================== -->
  <div class="main-wrapper">

    <!-- START: Top Navbar Component -->
    @include('admin.layout.inc.header')
    <!-- END: Top Navbar Component -->

    <!-- START: Page Header Banner -->
    @section('page-header')
    <div class="page-header">
      <div>
        <h1 class="page-title">@yield('page-title', 'Blank Page')</h1>
        <p class="page-subtitle">@yield('subtitle', 'A blank starter template page for custom extensions.')</p>
      </div>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}" class="text-decoration-none text-muted-green">Home</a></li>
          <li class="breadcrumb-item active text-main" aria-current="page">@yield('page-title', 'Blank Page')</li>
        </ol>
      </nav>
    </div>
    @show
    <!-- END: Page Header Banner -->

    <!-- START: Dynamic Content Area -->
    @yield('content')
    <!-- END: Dynamic Content Area -->

  </div>
  <!-- ==========================================
         END: Main Content Area
         ========================================== -->

  <!-- Local Third-Party Libraries Script dependencies -->
  <script src="{{ asset("assets/libs/bootstrap/js/bootstrap.bundle.min.js") }}"></script>
  <script src="{{ asset("assets/libs/apexcharts/apexcharts.min.js") }}"></script>
  <script src="{{ asset("assets/libs/flatpickr/flatpickr.min.js") }}"></script>

  <!-- Local dashboard interactions controller -->
  <script src="{{ asset("assets/js/dashboard.js") }}"></script>
</body>

</html>
