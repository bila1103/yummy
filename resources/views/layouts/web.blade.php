<!doctype html>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <link href="https://cdn.jsdelivr.net" rel="preconnect" crossorigin="anonymous" />
  <link href="https://fonts.bunny.net" rel="preconnect" crossorigin="anonymous" />

  @once
    @include('partials.global.meta')
    @include('partials.library.remixicon')
    @include('partials.library.awesomenotification')
    @include('partials.library.bootstrap')
    @include('partials.library.fontinter')
    @include('partials.library.splide')
  @endonce
  <link rel="stylesheet" href="{{ asset('assets/css/web.css') }}">
  @stack('styles')
</head>

<body>
  @include('partials.web.header')
  @yield('content')
  @include('partials.web.footer')

  @stack('scripts')

</body>

</html>
