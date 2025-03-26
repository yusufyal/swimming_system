<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="description" content="Responsive Laravel Admin Dashboard Template based on Bootstrap 5">
  <meta name="author" content="NobleUI">
  <meta name="keywords" content="nobleui, bootstrap, bootstrap 5, bootstrap5, admin, dashboard, template, responsive, css, sass, html, laravel, theme, front-end, ui kit, web">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title') - Swimming Academy</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
  <!-- End fonts -->

  <!-- CSRF Token -->
  <meta name="_token" content="{{ csrf_token() }}">

  <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}">

  <!-- Core CSS -->
  <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />
  
  <!-- Plugin CSS -->
  <link href="{{ asset('assets/fonts/feather-font/css/iconfont.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/flatpickr/flatpickr.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
  <!-- End plugin CSS -->

  @stack('plugin-styles')
  @stack('style')
</head>

<body data-base-url="{{url('/')}}">

  <script src="{{ asset('assets/js/spinner.js') }}"></script>

  <div class="main-wrapper" id="app">
    <div class="page-wrapper full-page">
      @yield('content')
    </div>
  </div>

  <!-- Core JS -->
  <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/js/feather-icons/feather.min.js') }}"></script>
  <script src="{{ asset('assets/js/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('assets/js/app.js') }}"></script>
  
  <!-- Plugin JS -->
  <script src="{{ asset('assets/plugins/flatpickr/flatpickr.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/feather-icons/feather.min.js') }}"></script>
  
  <!-- Template JS -->
  <script src="{{ asset('assets/js/template.js') }}"></script>
  <script src="{{ asset('assets/js/custom.js') }}"></script>

  @stack('plugin-scripts')
  @stack('custom-scripts')
</body>

</html>