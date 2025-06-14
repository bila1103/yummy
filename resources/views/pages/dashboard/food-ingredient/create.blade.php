@extends('layouts.dashboard')
@php
  $breadcrumbs = [
      ['label' => 'Dashboard', 'url' => route('dashboard')],
      ['label' => 'Food'],
      ['label' => 'Food Ingredient', 'url' => route('dashboard.food-ingredient.index')],
      ['label' => 'Tambah Ingredient'],
  ];
@endphp

@section('action')
  <a href="{{ route('dashboard.food-ingredient.index') }}" class="btn btn-secondary">
    <i class="ri-arrow-left-line"></i>
    Kembali
  </a>
@endsection

@section('content')
  <div class="col-12 col-lg-8 mx-auto">
    <form id="form-ingredient" action="{{ route('dashboard.food-ingredient.store') }}" method="POST" class="card my-5"
      enctype="multipart/form-data">
      <div class="card-header border-bottom">
        <h5 class="mb-0">
          <i class="ri-add-line"></i>
          <span class="fw-bold">Tambah Ingredient</span>
        </h5>
      </div>
      <div class="card-body">
        <div class="row g-3">
          <div class="col-7">
            <div class="mb-3">
              <label for="name" class="form-label required">Nama</label>
              <input class="form-control @error('name') is-invalid @enderror rounded-0" name="name"
                value="{{ old('name') }}" id="name" placeholder="Nama Ingredient" type="text" required>
              @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div>
              <label for="image" class="form-label">Image</label>
              <input type="file" name="image" id="image"
                class="form-control @error('image') is-invalid @enderror rounded-0" accept="image/*">
              @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>
          <div class="col-5">
            {{-- image preview with border --}}
            <img id="image-preview" class="img-fluid rounded-2" src="{{ asset('assets/img/noimage.webp') }}"
              alt="Preview Image" style="width: 100%; height: 100%; object-fit: cover;">
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
            <span>Tambah Ingredient</span>
            <i class="ri-add-line"></i>
          </button>
        </div>
      </div>
    </form>
  </div>
@endsection


@push('scripts')
  <script>
    const form = document.getElementById('form-ingredient');
    const defaultImage = "{{ asset('assets/img/noimage.webp') }}";
    document.getElementById('image').addEventListener('change', function() {
      const file = this.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
          document.getElementById('image-preview').src = e.target.result;
        }
        reader.readAsDataURL(file);
      } else {
        document.getElementById('image-preview').src = defaultImage;
      }
    });

    form.addEventListener('reset', function() {
      document.getElementById('image-preview').src = defaultImage;
    });
  </script>
@endpush
