@extends('layouts.dashboard')
@php
  $breadcrumbs = [
      ['label' => 'Dashboard', 'url' => route('dashboard')],
      ['label' => 'Food'],
      ['label' => 'Food Information', 'url' => route('dashboard.food-info.index')],
  ];
@endphp

@section('action')
  <a href="{{ route('dashboard.food-info.create') }}" class="btn btn-primary">
    <i class="ri-add-line"></i>
    Add Information
  </a>
@endsection

@section('content')
  <div class="card card-body p-0">
    <div class="table-responsive">
      <table class="table table-bordered table-hover mb-0">
        <thead class="table-secondary">
          <tr>
            <th>Nama</th>
            <th>Description</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @if ($foodInfos->isEmpty())
            <tr>
              <td colspan="3" class="text-center">Tidak ada data</td>
            </tr>
          @endif
          @foreach ($foodInfos as $foodInfo)
            <tr>
              <td>{{ $foodInfo->name }}</td>
              <td>
                {{ $foodInfo->description ? Str::limit($foodInfo->description, 50, '...') : '-' }}
              </td>
              <td>
                <div class="d-flex gap-1">
                  <a class="btn btn-sm btn-warning" href="{{ route('dashboard.food-info.edit', $foodInfo->id) }}">
                    <i class="ri-edit-line"></i>
                  </a>
                  <form action="{{ route('dashboard.food-info.destroy', $foodInfo->id) }}" method="POST"
                    class="d-inline form-deletes" data-code="{{ $foodInfo->name }}">
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
        @if ($foodInfos->hasPages())
          <tfoot>
            <tr>
              <td colspan="3">
                {{ $foodInfos->links('vendor.pagination.custom') }}
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
              title: `<h4 class='fw-bold mb-0'>Hapus Information ${code} ?</h4>`,
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
