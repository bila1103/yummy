<div class="container">
    <div class="my-4">
        @if (is_array($categories) && count($categories) > 0)
            <h4 class="fw-bold mb-4">Kategori Resep</h4>
            <div class="d-flex flex-wrap gap-3">
                @foreach ($categories as $category)
                    <span class="custom-badge">{{ $category->name }}</span>
                @endforeach
            </div>
        @endif
    </div>
</div>

@push('styles')
    <style>
        .custom-badge {
            border: 2px solid #ff9800;
            color: #ff9800;
            border-radius: 30px;
            padding: 8px 18px;
            font-size: 0.875rem;
            /* setara dengan fs-6 */
            font-weight: 500;
            background: #fff;
            display: inline-block;
            margin-bottom: 10px;
            transition: all 0.18s;
            cursor: pointer;
        }

        .custom-badge:hover {
            background: #ff9800;
            color: #fff;
            box-shadow: 0 2px 8px rgba(255, 152, 0, 0.08);
            transform: translateY(-2px) scale(1.05);
        }
    </style>
@endpush
