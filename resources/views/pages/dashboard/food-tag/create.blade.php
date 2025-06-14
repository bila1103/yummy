@extends('layouts.dashboard')
@php
  $breadcrumbs = [
      ['label' => 'Dashboard', 'url' => route('dashboard')],
      ['label' => 'Food'],
      ['label' => 'Food Tag', 'url' => route('dashboard.food-tag.index')],
      ['label' => 'Tambah'],
  ];
@endphp

@section('action')
  <a href="{{ route('dashboard.food-tag.index') }}" class="btn btn-secondary">
    <i class="ri-arrow-left-line"></i>
    Kembali
  </a>
@endsection

@section('content')
  <div class="col-12 col-lg-8 mx-auto">
    <form id="form-info" action="{{ route('dashboard.food-tag.store') }}" method="POST" class="card my-5">
      <div class="card-header border-bottom">
        <h5 class="mb-0">
          <i class="ri-add-line"></i>
          <span class="fw-bold">Tambah Tag</span>
        </h5>
      </div>
      <div class="card-body">
        <div class="row g-3">
          <div class="col-12">
            <div class="mb-3">
              <label for="name" class="form-label required">Nama</label>
              <input class="form-control @error('name') is-invalid @enderror rounded-0" name="name"
                value="{{ old('name') }}" id="name" placeholder="Food Tag" type="text" required>
              @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div>
              <label for="description" class="form-label">Deskripsi</label>
              <textarea rows="5" class="form-control @error('description') is-invalid @enderror rounded-0" name="description"
                id="description" placeholder="Food Description">{{ old('description') }}</textarea>
              @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>
        </div>
      </div>
      <div class="card-footer border-top">
        @csrf
        <div class="d-flex gap-0">
          <button type="reset" class="btn btn-danger rounded-0 w-25">
            <span>Reset</span>
            <i class="ri-refresh-line"></i>
          </button>
          <button type="submit" class="btn btn-success rounded-0 w-75">
            <span>Tambah Tag</span>
            <i class="ri-add-line"></i>
          </button>
        </div>
      </div>
    </form>
  </div>
@endsection
