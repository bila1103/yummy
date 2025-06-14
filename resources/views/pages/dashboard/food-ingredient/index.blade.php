@extends('layouts.dashboard')
@php
  $breadcrumbs = [
      ['label' => 'Dashboard', 'url' => route('dashboard')],
      ['label' => 'Food'],
      ['label' => 'Food Ingredient', 'url' => route('dashboard.food-ingredient.index')],
  ];
@endphp

@section('action')
  <a href="{{ route('dashboard.food-ingredient.create') }}" class="btn btn-primary">
    <i class="ri-add-line"></i>
    Add Ingredient
  </a>
@endsection

@section('content')
  <div class="card card-body p-0">
    <div class="table-responsive">
      <table class="table table-bordered table-hover mb-0">
        <thead class="table-secondary">
          <tr>
            <th>Nama</th>
            <th>Image</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @if ($ingredients->isEmpty())
            <tr>
              <td colspan="3" class="text-center">Tidak ada data</td>
            </tr>
          @endif
          @foreach ($ingredients as $ingredient)
            <tr>
              <td>{{ $ingredient->name }}</td>
              <td>
                @if ($ingredient->image_url)
                  <img width="50" height="50" src="{{ asset($ingredient->image_url) }}"
                    alt="{{ $ingredient->name }}" class="rounded-2 me-2">
                @else
                  <img width="50" height="50" src="{{ asset('assets/img/noimage.webp') }}">
                @endif
              </td>
              <td>
                <div class="d-flex gap-1">
                  <a class="btn btn-sm btn-warning" href="{{ route('dashboard.food-ingredient.edit', $ingredient->id) }}">
                    <i class="ri-edit-line"></i>
                  </a>
                  <form action="{{ route('dashboard.food-ingredient.destroy', $ingredient->id) }}" method="POST"
                    class="d-inline form-deletes" data-code="{{ $ingredient->name }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">
                      <i class="ri-delete-bin-line"></i>
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
        @if ($ingredients->hasPages())
          <tfoot>
            <tr>
              <td colspan="3">
                {{ $ingredients->links('vendor.pagination.custom') }}
              </td>
            </tr>
          </tfoot>
        @endif
      </table>
    </div>
  </div>
@endsection

@push('scripts')
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const formDeletes = document.querySelectorAll('.form-deletes');
      formDeletes.forEach(formDelete => {
        formDelete.addEventListener('submit', function(e) {
          e.preventDefault();
          const code = this.dataset.code;
          Swal.fire({
              title: `<h4 class='fw-bold mb-0'>Hapus Ingredient ${code} ?</h4>`,
              html: "<small>Item dan data terkait akan dihapus secara permanen</small>",
              ...swalDeleteConfirmation
            })
            .then((result) => {
              if (result.isConfirmed) this.submit();
            });
        });
      });
    });
  </script>
@endpush
