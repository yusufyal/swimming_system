<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ session('direction', 'ltr') }}">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="description" content="Responsive Laravel Admin Dashboard Template based on Bootstrap 5">
  <meta name="author" content="NobleUI">
  <meta name="keywords" content="nobleui, bootstrap, bootstrap 5, bootstrap5, admin, dashboard, template, responsive, css, sass, html, laravel, theme, front-end, ui kit, web">

  <title>Swimming Academy</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
  <!-- End fonts -->

  <!-- FontAwesome CDN -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

  <!-- CSRF Token -->
  <meta name="_token" content="{{ csrf_token() }}">

  <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}">

  <!-- plugin css -->
  <link href="{{ asset('assets/fonts/feather-font/css/iconfont.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" />
  <!-- end plugin css -->

  @stack('plugin-styles')

  <!-- common css -->
  <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet" />
  <!-- end common css -->

  @stack('style')

  <!-- Load jQuery first -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body data-base-url="{{url('/')}}" id="body" dir="{{ session('direction', 'ltr') }}">

  <script src="{{ asset('assets/js/spinner.js') }}"></script>

  <div class="main-wrapper" id="app" lang="{{ app()->getLocale() }}" dir="{{ session('direction', 'ltr') }}">
    @include('layout.sidebar')
    <div class="page-wrapper">
      @include('layout.header')
      <div class="page-content">
        @yield('content')
      </div>
      @include('layout.footer')
    </div>
  </div>

  <!-- All scripts after jQuery -->
  <script src="{{ asset('assets/js/jquery.flot.js') }}"></script>
  <script src="{{ asset('assets/js/jquery.flot.resize.js') }}"></script>
  <script src="{{ asset('assets/js/jquery.flot.pie.js') }}"></script>
  <script src="{{ asset('assets/js/jquery.flot.categories.js') }}"></script>
  <script src="{{ asset('assets/plugins/feather-icons/feather.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
  
  <!-- plugin js -->
  @stack('plugin-scripts')
  <!-- end plugin js -->

  <!-- common js -->
  <script src="{{ asset('assets/js/template.js') }}"></script>
  <script src="{{ asset('assets/js/dashboard.js') }}"></script>
  <!-- end common js -->

  @stack('custom-scripts')

  <script>
    const languageToggleBtn = document.getElementById("language-toggle-btn");

    const currentLanguage = "{{ app()->getLocale() }}";

    if (currentLanguage === 'ar') {
      languageToggleBtn.textContent = 'Arabic';
      languageToggleBtn.style.backgroundColor = "#f6cb24";
    } else {
      languageToggleBtn.textContent = 'English';
      languageToggleBtn.style.backgroundColor = "#f6cb24";
    }

    languageToggleBtn.addEventListener('click', function(e) {
      e.preventDefault();

      if (languageToggleBtn.textContent.trim().toLowerCase() === 'english') {
        languageToggleBtn.textContent = 'Arabic';
        languageToggleBtn.style.backgroundColor = "#f6cb24";
        window.location.href = "{{ url('setlanguage/ar') }}";
      } else {
        languageToggleBtn.textContent = 'English';
        languageToggleBtn.style.backgroundColor = "#f6cb24";
        window.location.href = "{{ url('setlanguage/en') }}";
      }
    });
  </script>
</body>

</html>