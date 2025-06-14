<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">

  <link href="https://cdn.jsdelivr.net" rel="preconnect" crossorigin="anonymous" />
  <link href="https://fonts.bunny.net" rel="preconnect" crossorigin="anonymous" />

  @once
    @include('partials.global.meta')
    @include('partials.library.remixicon')
    @include('partials.library.awesomenotification')
    @include('partials.library.sweetalert2')
    @include('partials.library.lodash')
  @endonce

  {{-- General CSS Files --}}
  <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/light.css') }}">

  <link rel="stylesheet" crossorigin="anonymous"
    href="https://fonts.bunny.net/css?family=inter:100,200,300,400,500,600,700,800,900" />

  {{-- Highcharts 11.4.0 --}}
  <script crossorigin="anonymous" src="https://cdn.jsdelivr.net/npm/highcharts@11.4.0/highcharts.min.js"></script>
  <script crossorigin="anonymous" src="https://cdn.jsdelivr.net/npm/highcharts@11.4.0/modules/exporting.js"></script>
  <script crossorigin="anonymous" src="https://cdn.jsdelivr.net/npm/highcharts@11.4.0/modules/export-data.js"></script>
  <script crossorigin="anonymous" src="https://cdn.jsdelivr.net/npm/highcharts@11.4.0/modules/accessibility.js"></script>

  @stack('styles')
</head>

<body data-theme="dark">
  <div class="wrapper">
    @include('partials.dashboard.sidebar')
    <div class="main">
      @include('partials.dashboard.navbar')
      <main class="content">
        <div class="container-fluid p-0">
          <div class="d-flex flex-wrap align-items-center justify-content-between mb-3">
            @include('partials.dashboard.breadcrumb')
            <div>
              @yield('action')
            </div>
          </div>

          @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show p-3 mb-3" role="alert">
              <span><strong>Success!</strong> {{ session('success') }}</span>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif

          @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show p-3 mb-3" role="alert">
              <span><strong>Error!</strong> {{ session('error') }}</span>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif

          @if (session('info'))
            <div class="alert alert-info alert-dismissible fade show p-3 mb-3" role="alert">
              <span><strong>Information!</strong> {{ session('info') }}</span>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif

          @yield('content')
        </div>
      </main>

      @include('partials.dashboard.footer')
    </div>
  </div>

  {{-- Loader --}}
  <div aria-hidden="true" class="d-flex align-items-center justify-content-center vh-100 vw-100 top-0 start-0"
    id="c-backdrop">
    <div aria-label="Loading..." class="spinner-border text-light" role="status" style="height: 3rem; width: 3rem;">
    </div>
  </div>

  {{-- General JS Files --}}
  <script src="https://cdn.jsdelivr.net/npm/@adminkit/core@3.4.0/dist/js/app.js"
    integrity="sha256-hOQjxk0NxkT3zx9wQyyTN/rKs4sr3R8TwUOHfLsY+tc=" crossorigin="anonymous"></script>
  <script src="{{ asset('assets/js/dashboard.js') }}"></script>
  @stack('scripts')
  @if (session('success'))
    <script>
      awn.success("{{ session('success') }}");
    </script>
  @endif
</body>

</html>
