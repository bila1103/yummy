 <div class="row g-4">
     @foreach ($recipes as $recipe)
         <div class="col-md-6 col-lg-4">
             <a href="{{ route('detail', $recipe['slug']) }}" class="card border-0 shadow-sm h-100 position-relative text-decoration-none">
                 <div class="card-header bg-white border-0 pt-3 pb-0 px-3">
                     <div class="d-flex align-items-center">
                         <div class="user-avatar me-2">
                             <img loading="lazy" src="{{ $recipe['user']['avatar'] }}" alt="{{ $recipe['user']['name'] }}"
                                 class="rounded-circle" width="36" height="36" style="object-fit:cover;">
                         </div>
                         <div class="user-name fw-semibold" style="font-size:1.09rem;">
                             {{ $recipe['user']['name'] }}</div>
                         @if ($recipe['user']['is_verified'])
                             <i class="ri-verified-badge-fill text-primary ms-2"></i>
                         @endif
                     </div>
                 </div>
                 <div class="card-body p-3">
                     @if ($recipe['tested'])
                         <span class="badge-tes position-absolute" style="top:65px;left:0px;">Resep
                             Teruji</span>
                     @endif
                     <img loading="lazy" src="{{ $recipe['image'] }}" alt="{{ $recipe['title'] }}" class="card-img rounded mb-2 w-100"
                         style="object-fit:cover;height:150px;">
                     <h5 class="card-title mb-0 mt-2">{{ $recipe['title'] }}</h5>
                     <div class="recipe-meta d-flex align-items-center mt-2 mb-1 justify-content-between">
                         <div class="rating me-3">
                             <i class="ri-star-fill text-warning"></i>
                             <span class="rating-value">({{ number_format($recipe['rating'], 1) }})</span>
                         </div>
                         <div class="kalori me-3">
                             <i class="ri-fire-fill text-danger"></i>
                             <span>{{ $recipe['calories'] ?? '-' }}</span>
                         </div>
                     </div>
                     <div class="recipe-views-bookmark d-flex align-items-center justify-content-between mt-1">
                         <div class="recipe-views">
                             <i class="ri-eye-fill"></i> {{ $recipe['visited_count'] }}
                         </div>
                         <button class="btn btn-light bookmark-btn rounded-circle">
                             <i class="ri-bookmark-line"></i>
                         </button>
                     </div>
                 </div>
             </a>
         </div>
     @endforeach
 </div>
