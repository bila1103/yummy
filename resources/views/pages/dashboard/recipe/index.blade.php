@extends('layouts.dashboard')
@php
  $breadcrumbs = [
      ['label' => 'Dashboard', 'url' => route('dashboard')],
      ['label' => 'Recipe', 'url' => route('dashboard.recipe.index')],
  ];
@endphp

@section('action')
  <a href="{{ route('dashboard.recipe.create') }}" class="btn btn-primary">
    <i class="ri-add-line"></i>
    Add Recipe
  </a>
@endsection

@section('content')
  <div class="card card-body p-0">
    <div class="table-responsive">
      <table class="table table-bordered table-hover mb-0">
        <thead class="table-secondary">
          <tr>
            <th>Nama</th>
            <th>Creator</th>
            <th>Rating</th>
            <th>Image</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @if ($recipes->isEmpty())
            <tr>
              <td colspan="3" class="text-center">Tidak ada data</td>
            </tr>
          @endif
          @foreach ($recipes as $recipe)
            <tr>
              <td>{{ $recipe->title }}</td>
              <td>{{ $recipe->user->name }}</td>
              <td>
                @for ($i = 1; $i <= $recipe->rating; $i++)
                  <i class="ri-star-fill text-warning"></i>
                @endfor
                @if ($recipe->rating < 1)
                  <span class="text-muted">Belum ada rating</span>
                @endif
              </td>
              <td>
                @if ($recipe->image)
                  <img width="50" height="50" src="{{ asset($recipe->image) }}" alt="{{ $recipe->name }}"
                    class="rounded-2 me-2">
                @else
                  <img width="50" height="50" src="{{ asset('assets/img/noimage.webp') }}">
                @endif
              </td>
              <td>
                <div class="d-flex gap-1">
                  <a class="btn btn-sm btn-primary" href="{{ route('dashboard.recipe.show', $recipe->id) }}">
                    <i class="ri-eye-line"></i>
                  </a>
                  <a class="btn btn-sm btn-warning" href="{{ route('dashboard.recipe.edit', $recipe->id) }}">
                    <i class="ri-edit-line"></i>
                  </a>
                  <form action="{{ route('dashboard.recipe.destroy', $recipe->id) }}" method="POST"
                    class="d-inline form-deletes" data-code="{{ $recipe->title }}">
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
        @if ($recipes->hasPages())
          <tfoot>
            <tr>
              <td colspan="5">
                {{ $recipes->links('vendor.pagination.custom') }}
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
              title: `<h4 class='fw-bold mb-0'>Hapus Resep ${code} ?</h4>`,
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
