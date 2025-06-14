<section class="bahan-resep-filter-section py-4 container-fluid">
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb bg-transparent p-0 small">
            <li class="breadcrumb-item"><a href="#" class="text-warning">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Bahan</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-lg-3 mb-4">
            <form id="ingredient-filter-form">
                @csrf
                <div class="filter-sidebar rounded-4 shadow-sm p-0 bg-white">
                    <div class="search-bahan p-3 border-bottom">
                        <input type="text" id="search-input" class="form-control filter-search-input"
                            placeholder="Cari Bahan" style="border-radius:12px;">
                    </div>
                    <div class="filter-sidebar-scrollable">
                        <div class="bahan-populer pt-3">
                            <div class="fw-bold mb-2 px-3" style="font-size:1.08rem;">Bahan Populer Minggu Ini</div>
                            @foreach ($bahanPopuler as $b)
                                <label class="d-flex align-items-center mb-2 cursor-pointer px-3 bahan-item">
                                    <img loading="lazy" src="{{ $b['image_url'] }}" alt="{{ $b['name'] }}"
                                        style="width:36px;height:36px;object-fit:contain;" class="me-2">
                                    <span class="flex-grow-1 bahan-name">{{ $b['name'] }}</span>
                                    <input type="checkbox" name="ingredients[]" value="{{ $b['id'] }}"
                                        class="form-check-input ms-2 ingredient-checkbox" style="accent-color:#ffaa2c;"
                                        {{ isset($b['checked']) && $b['checked'] ? 'checked' : '' }}>
                                </label>
                            @endforeach
                        </div>
                        <div class="bahan-lain pt-3">
                            <div class="fw-bold mb-2 px-3" style="font-size:1.08rem;">Bahan Lainnya</div>

                            @foreach ($bahanLain as $huruf => $items)
                                <div class="text-muted fw-bold px-3 mt-3" style="font-size:1.02rem;">{{ $huruf }}
                                </div>

                                @foreach ($items as $b)
                                    <label class="d-flex align-items-center mb-2 cursor-pointer px-3 bahan-item">
                                        <img loading="lazy" src="{{ $b['image_url'] }}" alt="{{ $b['name'] }}"
                                            style="width:36px;height:36px;object-fit:contain;" class="me-2">
                                        <span class="flex-grow-1 bahan-name">{{ $b['name'] }}</span>
                                        <input type="checkbox" name="ingredients[]" value="{{ $b['id'] }}"
                                            class="form-check-input ms-2 ingredient-checkbox"
                                            style="accent-color:#ffaa2c;"
                                            {{ isset($b['checked']) && $b['checked'] ? 'checked' : '' }}>
                                    </label>
                                @endforeach
                            @endforeach
                        </div>
                    </div>
                    <div class="sidebar-footer p-3 bg-light border-top mt-0">
                        <div class="text-warning small fw-semibold" id="selected-count">
                            <span id="count-number">0</span> bahan telah terpilih
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- Main Recipe Result Area -->
        <div class="col-lg-9">
            <div class="mb-3 d-flex flex-wrap align-items-center gap-2">
                <span style="font-size:1rem;" id="recipe-count-text">
                    Menampilkan resep untuk bahan yang dipilih
                </span>
            </div>
            <div class="mb-3 d-flex flex-wrap align-items-center gap-2" id="selected-badges-container">
                <!-- Selected ingredients badges will be displayed here -->
                <button class="btn btn-outline-primary btn-sm px-3 fw-semibold" id="clear-all-btn"
                    style="display: none;">Hapus Semua</button>
            </div>
            <div class="recipes-area" id="recipes-area">
                @if (count(request()->input('ingredients', [])) === 0)
                    <div class="text-center py-5">
                        <img loading="lazy" src="{{ asset('assets/img/empty-state.png') }}" alt="Pilih bahan untuk melihat resep"
                            class="img-fluid mb-3" style="max-width: 250px;">
                    </div>
                    <div>
                        <h4 class="mt-3">Belum ada bahan dipilih</h4>
                        <p class="text-muted">Pilih bahan makanan untuk melihat resep yang sesuai</p>
                    </div>
                @else
                    @include('components.ingredients.recipes-filter', ['recipes' => $recipes])
                @endif
            </div>
        </div>
        <x-ingredients.pagination :current-page="request()->get('page', 1)" :total-pages="12" :url="request()->url()" />
    </div>
</section>

@push('styles')
    <style>
        .filter-sidebar {
            min-width: 250px;
            max-width: 320px;
            border: 1.5px solid #e5e8ee;
            background: #fff;
            max-height: 520px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .filter-sidebar-scrollable {
            overflow-y: auto;
            flex: 1 1 auto;
            padding-bottom: 12px;
        }

        .filter-search-input {
            background: #f5f7fa;
            border: 1.5px solid #e5e8ee;
            font-size: 1rem;
            padding: 10px 14px;
        }

        .filter-search-input:focus {
            background: #fff;
            border-color: #ffaa2c;
            outline: none;
            box-shadow: 0 2px 10px rgba(255, 168, 44, 0.04);
        }

        .badge-filter-active {
            background: #fef3e3;
            border-radius: 20px;
            color: #ff9800;
            font-weight: 500;
            padding: 5px 16px;
            font-size: 1rem;
            display: inline-flex;
            align-items: center;
            margin-right: 8px;
            margin-bottom: 8px;
        }

        .badge-filter-active .remove-badge {
            background: none;
            border: none;
            color: #ff9800;
            font-size: 1.2rem;
            margin-left: 8px;
            cursor: pointer;
            padding: 0;
            line-height: 1;
        }

        .badge-filter-active .remove-badge:hover {
            color: #e68900;
        }

        .badge-tes {
            background: #ff4d4f;
            color: #fff;
            font-size: 0.89rem;
            font-weight: 600;
            border-radius: 12px;
            padding: 3.5px 16px;
            z-index: 2;
            box-shadow: 0 3px 8px rgba(255, 77, 79, 0.06);
        }

        .card-img {
            object-fit: cover;
            border-radius: 16px;
        }

        .bookmark-btn {
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
            border-radius: 50%;
            background-color: #f8f9fa;
            color: #000000;
            font-weight: 500;
            border: none;
        }

        .bookmark-btn:hover {
            background-color: #ffc107;
            color: #343a40;
        }

        .rating i,
        .kalori i {
            font-size: 1.1rem;
        }

        .breadcrumb .text-warning {
            color: #ffaa2c !important;
        }

        .filter-sidebar label {
            cursor: pointer;
            user-select: none;
        }

        .sidebar-footer {
            font-size: 0.95rem;
        }

        .bahan-item.hidden {
            display: none !important;
        }

        .loading-spinner {
            text-align: center;
            padding: 40px;
        }

        .spinner-border {
            width: 3rem;
            height: 3rem;
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('ingredient-filter-form');
            const recipesArea = document.getElementById('recipes-area');
            const selectedBadgesContainer = document.getElementById('selected-badges-container');
            const clearAllBtn = document.getElementById('clear-all-btn');
            const countNumber = document.getElementById('count-number');
            const recipeCountText = document.getElementById('recipe-count-text');
            const searchInput = document.getElementById('search-input');
            const bahanItems = document.querySelectorAll('.bahan-item');
            const paginationSection = document.querySelector('.pagination-section');
            const paginationContainer = document.querySelector('.pagination-section .container .row .col-auto');

            let selectedIngredients = new Map(); // Store selected ingredients with their names
            let currentPage = 1; // Track current page

            // Initialize selected ingredients from checked checkboxes
            function initializeSelectedIngredients() {
                const checkedBoxes = document.querySelectorAll('.ingredient-checkbox:checked');
                checkedBoxes.forEach(checkbox => {
                    const label = checkbox.closest('.bahan-item');
                    const name = label.querySelector('.bahan-name').textContent.trim();
                    selectedIngredients.set(checkbox.value, name);
                });
                updateSelectedBadges();
                updateSelectedCount();

                // Show initial state based on selected ingredients
                if (selectedIngredients.size === 0) {
                    showEmptyState();
                    hidePagination();
                } else {
                    filterRecipes(currentPage);
                }
            }

            // Show empty state with image
            function showEmptyState() {
                recipesArea.innerHTML = `
            <div class="text-center py-5">
                <img src="{{ asset('assets/img/empty-state.png') }}" alt="Pilih bahan untuk melihat resep" class="img-fluid mb-3" style="max-width: 250px;">
                <h4 class="mt-3">Belum ada bahan dipilih</h4>
                <p class="text-muted">Pilih bahan makanan untuk melihat resep yang sesuai</p>
            </div>
        `;
            }

            // Hide pagination section
            function hidePagination() {
                paginationSection.style.display = 'none';
            }

            // Show pagination section
            function showPagination() {
                paginationSection.style.display = 'block';
            }

            // Handle checkbox changes
            function handleCheckboxChange(event) {
                const checkbox = event.target;
                const label = checkbox.closest('.bahan-item');
                const name = label.querySelector('.bahan-name').textContent.trim();

                if (checkbox.checked) {
                    selectedIngredients.set(checkbox.value, name);
                } else {
                    selectedIngredients.delete(checkbox.value);
                }

                // Reset to page 1 when changing filters
                currentPage = 1;

                updateSelectedBadges();
                updateSelectedCount();

                if (selectedIngredients.size === 0) {
                    showEmptyState();
                    hidePagination();
                } else {
                    filterRecipes(currentPage);
                }
            }

            // Update selected ingredients badges
            function updateSelectedBadges() {
                // Clear existing badges (except clear all button)
                const badges = selectedBadgesContainer.querySelectorAll('.badge-filter-active');
                badges.forEach(badge => badge.remove());

                // Add badges for selected ingredients
                selectedIngredients.forEach((name, id) => {
                    const badge = document.createElement('span');
                    badge.className = 'badge-filter-active';
                    badge.innerHTML = `
                ${name}
                <button class="remove-badge" data-ingredient-id="${id}" type="button">&times;</button>
            `;
                    selectedBadgesContainer.insertBefore(badge, clearAllBtn);
                });

                // Show/hide clear all button
                clearAllBtn.style.display = selectedIngredients.size > 0 ? 'inline-block' : 'none';
            }

            // Update selected count
            function updateSelectedCount() {
                countNumber.textContent = selectedIngredients.size;
            }

            // Filter recipes via AJAX
            function filterRecipes(page = 1) {
                // Show loading spinner
                recipesArea.innerHTML = `
            <div class="loading-spinner">
                <div class="spinner-border text-warning" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="mt-2">Mencari resep...</p>
            </div>
        `;

                // Prepare form data
                const formData = new FormData();
                formData.append('_token', document.querySelector('input[name="_token"]').value);
                formData.append('page', page);

                selectedIngredients.forEach((name, id) => {
                    formData.append('ingredients[]', id);
                });

                // Make AJAX request
                fetch('/filter-resep-bahan', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        recipesArea.innerHTML = data.html;

                        // Update pagination if it exists and show it
                        if (data.paginationHtml && data.count > 0) {
                            paginationContainer.innerHTML = data.paginationHtml;
                            showPagination();
                            setupPaginationEventListeners
                        (); // Set up event listeners for the new pagination links
                        } else {
                            paginationContainer.innerHTML = ''; // Clear pagination if no pages
                            hidePagination(); // Hide pagination if no results
                        }

                        updateRecipeCountText(data.count || 0);

                        // Scroll to top smoothly after filter/pagination
                        window.scrollTo({
                            top: 0,
                            behavior: 'smooth'
                        });
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        recipesArea.innerHTML = `
                <div class="alert alert-danger">
                    <i class="ri-error-warning-line me-2"></i>
                    Gagal memuat resep. Silakan coba lagi.
                </div>
            `;
                        hidePagination(); // Hide pagination on error
                    });
            }

            // Set up event listeners for pagination links
            function setupPaginationEventListeners() {
                const paginationLinks = document.querySelectorAll('.custom-pagination .page-link');

                paginationLinks.forEach(link => {
                    if (link.getAttribute('href') !== '#') {
                        link.addEventListener('click', function(e) {
                            e.preventDefault();

                            // Extract page number from href
                            const url = new URL(link.href, window.location.origin);
                            const page = url.searchParams.get('page') || 1;

                            currentPage = parseInt(page);
                            filterRecipes(currentPage);

                            // Update URL without reloading
                            const newUrl = new URL(window.location.href);
                            newUrl.searchParams.set('page', page);
                            window.history.pushState({}, '', newUrl);
                        });
                    }
                });
            }

            // Update recipe count text
            function updateRecipeCountText(count) {
                if (selectedIngredients.size === 0) {
                    recipeCountText.textContent = 'Pilih bahan untuk melihat resep';
                } else {
                    recipeCountText.textContent = `Menampilkan ${count} resep untuk bahan yang dipilih`;
                }
            }

            // Handle badge removal
            function handleBadgeRemoval(event) {
                if (event.target.classList.contains('remove-badge')) {
                    const ingredientId = event.target.getAttribute('data-ingredient-id');

                    // Uncheck the corresponding checkbox
                    const checkbox = document.querySelector(`input[value="${ingredientId}"]`);
                    if (checkbox) {
                        checkbox.checked = false;
                    }

                    // Remove from selected ingredients
                    selectedIngredients.delete(ingredientId);

                    // Reset to page 1 when removing filters
                    currentPage = 1;

                    updateSelectedBadges();
                    updateSelectedCount();

                    if (selectedIngredients.size === 0) {
                        showEmptyState();
                        hidePagination();
                    } else {
                        filterRecipes(currentPage);
                    }
                }
            }

            // Handle clear all
            function handleClearAll() {
                // Uncheck all checkboxes
                const checkboxes = document.querySelectorAll('.ingredient-checkbox:checked');
                checkboxes.forEach(checkbox => {
                    checkbox.checked = false;
                });

                // Clear selected ingredients
                selectedIngredients.clear();

                // Reset to page 1 when clearing all filters
                currentPage = 1;

                updateSelectedBadges();
                updateSelectedCount();

                // Show empty state and hide pagination
                showEmptyState();
                hidePagination();
            }

            // Handle search functionality
            function handleSearch(event) {
                const searchTerm = event.target.value.toLowerCase().trim();

                bahanItems.forEach(item => {
                    const name = item.querySelector('.bahan-name').textContent.toLowerCase();
                    if (name.includes(searchTerm)) {
                        item.classList.remove('hidden');
                    } else {
                        item.classList.add('hidden');
                    }
                });
            }

            // Initial setup for URL param pagination
            function initFromUrlParams() {
                const urlParams = new URLSearchParams(window.location.search);
                const pageParam = urlParams.get('page');

                if (pageParam && !isNaN(parseInt(pageParam))) {
                    currentPage = parseInt(pageParam);
                }

                // Only load if there are selected ingredients
                if (selectedIngredients.size > 0) {
                    filterRecipes(currentPage);
                    showPagination();
                } else {
                    showEmptyState();
                    hidePagination();
                }
            }

            // Event listeners
            document.addEventListener('change', function(event) {
                if (event.target.classList.contains('ingredient-checkbox')) {
                    handleCheckboxChange(event);
                }
            });

            selectedBadgesContainer.addEventListener('click', handleBadgeRemoval);
            clearAllBtn.addEventListener('click', handleClearAll);
            searchInput.addEventListener('input', handleSearch);

            // Initialize
            initializeSelectedIngredients();
            initFromUrlParams();
            setupPaginationEventListeners();
            updateRecipeCountText(0);
        });
    </script>
@endpush
