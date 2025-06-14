@extends('layouts.auth')

@section('content')
  <div class="login-container">
    <div class="login-card">
      <!-- Logo -->
      <div class="text-center mb-4">
        <img src="{{ asset('apple-touch-icon.png') }}" width="60" alt="Logo">
      </div>

      <!-- Header -->
      <div class="text-center mb-4">
        <h1 class="h3 mb-2">Welcome Back</h1>
        <p class="text-muted">Please sign in to your account</p>
      </div>

      <!-- Login Form -->
      <form action="{{ route('login') }}" method="POST">
        @csrf

        <!-- Username Field -->
        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input id="username" name="username" type="text" class="form-control" placeholder="Enter your username"
            required>
        </div>

        <!-- Password Field -->
        <div class="mb-4">
          <label for="password" class="form-label">Password</label>
          <input id="password" name="password" type="password" class="form-control" placeholder="Enter your password"
            required>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary w-100 mb-3">
          Sign In
        </button>
        <div class="text sign-up-text">Don't have an account? <a href="{{ route('register') }}">Sign up now</a></div>
      </form>

      <!-- Footer -->
      <div class="text-center">
        <small class="text-muted">
          Yummy &copy; {{ date('Y') }}
        </small>
      </div>
    </div>
  </div>

  <style>
    .login-container {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
    }

    .login-card {
      background: white;
      padding: 2rem;
      border-radius: 8px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 400px;
    }

    .form-control {
      padding: 12px 16px;
      border: 1px solid #ddd;
      border-radius: 6px;
      font-size: 14px;
    }

    .form-control:focus {
      border-color: #0d6efd;
      box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
    }

    .btn-primary {
      padding: 12px;
      font-weight: 500;
      border-radius: 6px;
    }

    @media (max-width: 576px) {
      .login-card {
        padding: 1.5rem;
      }
    }
  </style>
@endsection
