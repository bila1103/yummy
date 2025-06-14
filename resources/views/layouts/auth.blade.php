<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  @once
    @include('partials.global.meta')
    @include('partials.library.remixicon')
    @include('partials.library.bootstrap')
  @endonce

  <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">

  <style>
    #auth {
      height: 100vh;
      overflow-x: hidden
    }

    #auth .form-group[class*=has-icon-] .form-control {
      padding-left: 2.5rem;
    }

    #auth .form-group[class*=has-icon-].has-icon-left .form-control-icon {
      left: 0;
      pointer-events: none;
    }

    #auth .form-group[class*=has-icon-] .form-control-icon {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      padding: 0 .8rem;
    }

    #auth #auth-left {
      flex-grow: 1;
      padding: 5rem;
    }

    #auth #auth-right {
      height: 100%;
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center;
      background-image: url('{{ asset('assets/img/banner.banner.webp') }}');
    }

    #auth .col-lg-5.col-12 {
      display: flex;
      align-items: center;
      justify-content: center;
    }

    #auth #auth-left .auth-title {
      font-size: 4rem;
      margin-bottom: 1rem
    }

    @media screen and (max-width:767px) {
      #auth #auth-left {
        padding: 0rem 1.3rem;
      }
    }
  </style>
</head>

<body data-author="rndio">
  <div id="auth">
    @yield('content')
  </div>

  @php
    $toastTypes = ['error', 'success', 'warning', 'info'];
    $toastClasses = [
        'error' => [
            'icon' => 'ri-error-warning-line',
            'class' => 'text-bg-danger',
        ],
        'success' => [
            'icon' => 'ri-check-line',
            'class' => 'text-bg-success',
        ],
        'warning' => [
            'icon' => 'ri-alert-line',
            'class' => 'text-bg-warning',
        ],
        'info' => [
            'icon' => 'ri-information-line',
            'class' => 'text-bg-info',
        ],
    ];
  @endphp

  <div class="toast-container position-fixed bottom-0 start-50 translate-middle p-6">
    @foreach ($toastTypes as $key)
      @php
        $toastClass = $toastClasses[$key];
        $class = $toastClass['class'];
        $icon = $toastClass['icon'];
      @endphp
      @if (session($key))
        <div class="toast {{ $class }}" role="alert" aria-live="assertive" aria-atomic="true">
          <div class="toast-body">
            <div class="d-flex gap-2">
              <span><i class="{{ $icon }} ri-xl"></i></span>
              <div class="d-flex flex-grow-1 align-items-center">
                <span class="fw-semibold">{{ session($key) }}</span>
                <button type="button" class="small btn-close btn-close-white btn-close-sm ms-auto"
                  data-bs-dismiss="toast" aria-label="Close"></button>
              </div>
            </div>
          </div>
        </div>
      @endif
    @endforeach
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const toastElList = document.querySelectorAll('.toast')
      const toastList = [...toastElList].map(toastEl => {
        return new bootstrap.Toast(toastEl, {
          autohide: true,
          delay: 5000
        })
      })

      toastList.forEach(toast => {
        toast.show()
      })
    })
  </script>
</body>

</html>
