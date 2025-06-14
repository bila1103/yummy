<div class="container">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb bg-transparent p-0">
            <li class="breadcrumb-item"><a href="" class="text-warning fw-semibold">Home</a></li>
            <li class="breadcrumb-item"><a href="" class="text-warning fw-semibold">Resep</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $recipe->title }}</li>
        </ol>
    </nav>

    <div class="row align-items-start g-4">
        <!-- Recipe Image -->
        <div class="col-lg-5 mb-4 mb-lg-0">
            <div class="recipe-image rounded overflow-hidden">
                <img loading="lazy" src="{{ asset($recipe->image) }}" alt="{{ $recipe->title }}" class="img-fluid w-100"
                    style="object-fit:cover;">
            </div>
        </div>
        <!-- Recipe Main Info -->
        <div class="col-lg-7">
            <h3 class="fw-bold mb-3">Resep {{ $recipe->title }}</h3>
            <div class="d-flex align-items-center mb-2">
                <img loading="lazy" src="{{ asset($recipe->user->avatar ?? '/storage/img/avatars/default.jpg') }}"
                    alt="{{ $recipe->user->name ?? '-' }}" class="rounded-circle" width="36" height="36"
                    style="object-fit:cover;">
                <span class="ms-2 fw-semibold">{{ $recipe->user->name ?? '-' }}</span>
                @if (!empty($recipe->user->is_verified))
                    <i class="ri-verified-badge-fill text-primary ms-1" title="Terverifikasi"></i>
                @endif
                <span class="ms-3 text-warning fw-bold d-flex align-items-center">
                    <i class="ri-star-fill me-1"></i> {{ $recipe->rating ?? '-' }}
                </span>
                <span class="ms-1 text-muted" style="font-size: 1rem;">({{ $recipe->rating_user ?? 0 }} Rating)</span>
            </div>
            <div class="mb-3 fs-5">
                {{ $recipe->description ?? '' }}
            </div>

            <div class="d-flex align-items-center mb-3">
                @foreach ($recipe->foodInfos as $item)
                    <span class="badge bg-warning text-white me-2">
                        <i class="ri-information-line"></i> {{ $item->name }}
                    </span>
                @endforeach
            </div>
            {{-- Ingredients Section (DYNAMIC) --}}
            @if (!empty($recipe->ingredient_type) && is_array($recipe->ingredient_type))
                @foreach ($recipe->ingredient_type as $ingredientGroup)
                    <h5 class="fw-bold mb-2 mt-4">{{ $ingredientGroup['name'] ?? '-' }}</h5>
                    <ul class="fs-5" style="list-style: disc inside;">
                        @foreach ($ingredientGroup['ingredients'] as $ingredient)
                            <li class="mb-2 d-flex align-items-center">
                                @if (!empty($ingredient['media_url']))
                                    <img loading="lazy" src="https://cdn.yummy.co.id/{{ $ingredient['media_url'] }}" alt="Foto Bahan"
                                        class="me-2"
                                        style="width:80px;height:80px;object-fit:cover;border-radius:8px;">
                                        <span>{{ $ingredient['description'] ?? '-' }}</span>
                                        @else
                                        <li>{{ $ingredient['description'] ?? '-' }}</li>
                                        @endif
                            </li>
                        @endforeach
                    </ul>
                @endforeach
            @endif
        </div>
    </div>

    <div class="mt-5">
        <h4 class="fw-bold mb-4">Cara Membuat</h4>

        {{-- Cooking Steps Section (DYNAMIC) --}}
        @if (!empty($recipe->cooking_step) && is_array($recipe->cooking_step))
            @foreach ($recipe->cooking_step as $step)
                <div class="mb-4 d-flex align-items-start">
                    <img loading="lazy" src="{{ asset($step['image_url']) }}" alt="{{ $step['title'] ?? 'Langkah' }}"
                        class="rounded me-4" style="width:160px; height:160px; object-fit:cover;">
                    <div>
                        <div class="fw-bold mb-1">{{ $step['title'] ?? '-' }}</div>
                        <div>{{ $step['text'] ?? '' }}</div>
                    </div>
                </div>
            @endforeach

            @if (count($recipe->cooking_step) == 2)
                <div class="alert alert-info mt-4">
                    Untuk langkah lengkap, <b>lihat selengkapnya di aplikasi</b>.
                </div>
            @endif
        @endif
    </div>
</div>

@push('styles')
    <style>
        ul.fs-5,
        div.fs-5 {
            font-size: 0.95rem !important;
        }

        .breadcrumb-item+.breadcrumb-item::before {
            color: #ff8a00;
        }

        .recipe-image img {
            border-radius: 20px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.045);
        }

        .breadcrumb .text-warning {
            color: #ff8a00 !important;
        }

        .btn-primary {
            background: #168cff;
            border: none;
            border-radius: 22px;
        }

        .btn-primary:hover {
            background: #0f72d6;
        }

        .emoji {
            font-size: 1.3em;
            vertical-align: middle;
        }

        .fw-bold {
            font-weight: 700 !important;
        }

        /* Responsive step images */
        @media (max-width: 767.98px) {
            .d-flex.align-items-start {
                flex-direction: column;
                align-items: flex-start !important;
            }

            .d-flex.align-items-start img {
                margin-bottom: 1rem;
                margin-right: 0 !important;
            }
        }
    </style>
@endpush
