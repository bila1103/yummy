@extends('layouts.dashboard')

@php
  $breadcrumbs = [
      ['label' => 'Dashboard', 'url' => route('dashboard')],
      ['label' => 'Profile', 'url' => route('dashboard.profile.index')],
  ];
@endphp

@section('content')
  <div class="d-flex flex-column justify-content-center align-items-center">
    <div class="col-12 col-lg-6">
      <div class="bg-light rounded-3 p-4">
        <div id="user-pic-wrapper" class="text-center">
          <img class="rounded-circle mb-2 shadow-lg" src="{{ auth()->user()->getProfilePicture() }}" height="120">
        </div>
        <form id="formProfile" class="col-12 mb-4" action="{{ route('dashboard.profile.update') }}" method="POST">
          <div class="mb-3">
            <label for="name" class="form-label small">Name</label>
            <input required id="name" name="name" value="{{ old('name') ?? $user->name }}" type="text"
              class="form-control @error('name') is-invalid @enderror">
            @error('name')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-3 @role('KEBUN') d-none @endrole">
            <label for="username" class="form-label small">Username</label>
            <input required id="username" name="username" value="{{ old('username') ?? $user->username }}" type="text"
              class="form-control @error('username') is-invalid @enderror">
            @error('username')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <small class="smaller text-muted">Used for authentication</small>
          </div>
          <div class="mb-3 text-end">
            @csrf
            @method('PUT')
            <button type="submit" class="btn btn-success w-100">
              <span>Update Profile</span>
              <i class="ri-user-fill"></i>
            </button>
          </div>
        </form>
        <form class="col-12" action="{{ route('dashboard.profile.updatepassword') }}" method="POST">
          <div class="mb-3">
            <label for="old_password" class="form-label small">Old Password</label>
            <input required id="old_password" name="old_password" type="password"
              class="form-control @error('old_password') is-invalid @enderror">
            @error('old_password')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-3">
            <label for="new_password" class="form-label small">New Password</label>
            <input required id="new_password" name="new_password" type="password"
              class="form-control @error('new_password') is-invalid @enderror">
            @error('new_password')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-3">
            <label for="confirm_password" class="form-label small">Confirm Password</label>
            <input required id="confirm_password" name="confirm_password" type="password"
              class="form-control @error('confirm_password') is-invalid @enderror">
            @error('confirm_password')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="text-end">
            @csrf
            @method('PUT')
            <button type="submit" class="btn btn-danger w-100">
              <span>Update Password</span>
              <i class="ri-lock-fill"></i>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const formProfile = document.getElementById('formProfile');

      formProfile.username.addEventListener('input', function() {
        this.value = this.value.replace(/\s/g, '');
      });
    })
  </script>
@endpush
