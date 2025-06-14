@extends('layouts.dashboard')
@php
    $breadcrumbs = [
        ['label' => 'Dashboard', 'url' => route('dashboard')],
        ['label' => 'Recipe', 'url' => route('dashboard.recipe.index')],
        ['label' => 'Tambah Recipe'],
    ];
@endphp

@section('action')
    <a href="{{ route('dashboard.recipe.index') }}" class="btn btn-secondary">
        <i class="ri-arrow-left-line"></i>
        Kembali
    </a>
@endsection

@section('content')
    <div class="col-12 col-lg-10 mx-auto">
        <form id="form-recipe" action="{{ route('dashboard.recipe.store') }}" method="POST" class="card my-5"
            enctype="multipart/form-data">
            <div class="card-header border-bottom">
                <h5 class="mb-0">
                    <i class="ri-add-line"></i>
                    <span class="fw-bold">Tambah Recipe</span>
                </h5>
            </div>
            <div class="card-body">
                <!-- Basic Information -->
                <div class="row g-3 mb-4">
                    <div class="col-7">
                        <div class="mb-3">
                            <label for="title" class="form-label required">Judul Recipe</label>
                            <input class="form-control @error('title') is-invalid @enderror rounded-0" name="title"
                                value="{{ old('title') }}" id="title" placeholder="Judul Recipe" type="text"
                                required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="food_tag" class="form-label">Tag</label>
                            <select class="form-select @error('food_tag') is-invalid @enderror rounded-0" name="food_tags[]"
                                id="food_tag" multiple>
                                @foreach ($food_tags as $food_tag)
                                    <option value="{{ $food_tag->id }}">{{ $food_tag->name }}</option>
                                @endforeach
                            </select>
                            @error('food_tag')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="food_info" class="form-label">Info</label>
                            <select class="form-select @error('food_info') is-invalid @enderror rounded-0" name="food_infos[]"
                                id="food_info" multiple>
                                @foreach ($food_infos as $food_info)
                                    <option value="{{ $food_info->id }}">{{ $food_info->name }}</option>
                                @endforeach
                            </select>
                            @error('food_info')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="ingredient" class="form-label">Bahan Makanan</label>
                            <select class="form-select @error('ingredient') is-invalid @enderror rounded-0" name="ingredients[]"
                                id="ingredient" multiple>
                                @foreach ($ingredients as $ingredient)
                                    <option value="{{ $ingredient->id }}">{{ $ingredient->name }}</option>
                                @endforeach
                            </select>
                            @error('ingredient')
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
                        <img id="image-preview" class="img-fluid rounded-2" src="{{ asset('assets/img/noimage.webp') }}"
                            alt="Preview Image" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                </div>

                <!-- Description -->
                <div class="mb-4">
                    <label for="description" class="form-label required">Deskripsi</label>
                    <textarea class="form-control @error('description') is-invalid @enderror rounded-0" name="description" id="description"
                        rows="4" placeholder="Deskripsi recipe..." required>{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Recipe Details -->
                <div class="row g-3 mb-4">
                    <div class="col-md-3">
                        <label for="price" class="form-label">Harga (Rp)</label>
                        <input type="number" class="form-control @error('price') is-invalid @enderror rounded-0"
                            name="price" id="price" value="{{ old('price') }}" placeholder="0">
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="calories" class="form-label">Kalori</label>
                        <input type="number" class="form-control @error('calories') is-invalid @enderror rounded-0"
                            name="calories" id="calories" value="{{ old('calories') }}" placeholder="0">
                        @error('calories')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="cooking_time" class="form-label">Waktu Masak (menit)</label>
                        <input type="number" class="form-control @error('cooking_time') is-invalid @enderror rounded-0"
                            name="cooking_time" id="cooking_time" value="{{ old('cooking_time') }}" placeholder="0">
                        @error('cooking_time')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Porsi</label>
                        <div class="d-flex gap-2">
                            <input type="number" class="form-control @error('serving_min') is-invalid @enderror rounded-0"
                                name="serving_min" placeholder="Min" value="{{ old('serving_min') }}">
                            <span class="align-self-center">-</span>
                            <input type="number"
                                class="form-control @error('serving_max') is-invalid @enderror rounded-0"
                                name="serving_max" placeholder="Max" value="{{ old('serving_max') }}">
                        </div>
                        @error('serving_min')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        @error('serving_max')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Cooking Steps -->
                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="mb-0">Langkah Memasak</h6>
                        <button type="button" class="btn btn-sm btn-primary" id="add-cooking-step">
                            <i class="ri-add-line"></i>
                            Tambah Langkah
                        </button>
                    </div>
                    <div id="cooking-steps-container">
                        <div class="cooking-step-item border rounded p-3 mb-3">
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label
                                        required">Deskripsi Langkah</label>
                                    <textarea class="form-control rounded-0" name="cooking_steps[0][text]" rows="3"
                                        placeholder="Jelaskan langkah memasak...">{{ old('cooking_steps.0.text', 'Langkah 1') }}</textarea>
                                    @error('cooking_steps.0.text')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-3">
                                    <label class="form-label">Judul Langkah</label>
                                    <input type="text" class="form-control rounded-0" name="cooking_steps[0][title]"
                                        placeholder="Langkah 1" value="Langkah 1">
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Urutan</label>
                                    <input type="number" class="form-control rounded-0" name="cooking_steps[0][order]"
                                        value="1" min="1">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Gambar Langkah</label>
                                    <input type="file" class="form-control rounded-0 cooking-step-image"
                                        name="cooking_steps[0][image]" accept="image/*">
                                </div>
                                <div class="col-md-3 d-flex align-items-end">
                                    <button type="button" class="btn btn-danger btn-sm remove-cooking-step w-100"
                                        disabled>
                                        <i class="ri-delete-bin-line"></i>
                                        Hapus
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Ingredient Types -->
                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="mb-0">Bahan-bahan</h6>
                        <button type="button" class="btn btn-sm btn-primary" id="add-ingredient-type">
                            <i class="ri-add-line"></i>
                            Tambah Kategori Bahan
                        </button>
                    </div>
                    <div id="ingredient-types-container">
                        <!-- Bahan Utama (Required) -->
                        <div class="ingredient-type-item border rounded p-3 mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="mb-0 text-primary">Bahan Utama</h6>
                                <button type="button" class="btn btn-sm btn-success add-ingredient">
                                    <i class="ri-add-line"></i>
                                    Tambah Bahan
                                </button>
                            </div>
                            <input type="hidden" name="ingredient_types[0][name]" value="Bahan Utama">
                            <div class="ingredients-container">
                                <div class="ingredient-item row g-2 mb-2 align-items-center">
                                    <div class="col-md-10">
                                        <input type="text" class="form-control form-control-sm rounded-0"
                                            name="ingredient_types[0][ingredients][0][description]"
                                            placeholder="Deskripsi bahan (contoh: 5 buah kulit pisang cavendis)">
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-sm btn-danger remove-ingredient w-100"
                                            disabled>
                                            <i class="ri-delete-bin-line"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
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
                        <span>Tambah Recipe</span>
                        <i class="ri-add-line"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tom-select@2.4.3/dist/css/tom-select.default.min.css" integrity="sha256-y4f6xz5LCue4H/dail/jRS6ABKJHmAbsFk943cOd5ms=" crossorigin="anonymous">
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.4.3/dist/js/tom-select.complete.min.js"
        integrity="sha256-t5cAXPIzePs4RIuA3FejMxOlxXe4QXZXQ7sfKJxNU+Y=" crossorigin="anonymous"></script>
     <script>
        new TomSelect("#food_tag",{
          maxItems: 5
        });
        new TomSelect("#food_info",{
          maxItems: 5
        });
        new TomSelect("#ingredient",{
          maxItems: 5,
          create: true,
        });
      </script>   
    <script>
        const form = document.getElementById('form-recipe');
        const defaultImage = "{{ asset('assets/img/noimage.webp') }}";
        let cookingStepIndex = 1;
        let ingredientTypeIndex = 1;

        // Image Preview
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

        // Reset form
        form.addEventListener('reset', function() {
            document.getElementById('image-preview').src = defaultImage;
            // Reset dynamic content
            cookingStepIndex = 1;
            ingredientTypeIndex = 1;
            resetCookingSteps();
            resetIngredientTypes();
        });

        // Cooking Steps Management
        document.getElementById('add-cooking-step').addEventListener('click', function() {
            addCookingStep();
        });

        function addCookingStep() {
            const container = document.getElementById('cooking-steps-container');
            const stepHtml = `
        <div class="cooking-step-item border rounded p-3 mb-3">
          <div class="row g-3">
            <div class="col-12">
              <label class="form-label
                required">Deskripsi Langkah</label>
              <textarea class="form-control rounded-0" name="cooking_steps[${cookingStepIndex}][text]" rows="3"
                placeholder="Jelaskan langkah memasak..."></textarea>
            </div>  
            <div class="col-md-3">
              <label class="form-label">Judul Langkah</label>
              <input type="text" class="form-control rounded-0" name="cooking_steps[${cookingStepIndex}][title]" 
                placeholder="Langkah ${cookingStepIndex + 1}" value="Langkah ${cookingStepIndex + 1}">
            </div>
            <div class="col-md-2">
              <label class="form-label">Urutan</label>
              <input type="number" class="form-control rounded-0" name="cooking_steps[${cookingStepIndex}][order]" 
                value="${cookingStepIndex + 1}" min="1">
            </div>
            <div class="col-md-4">
              <label class="form-label">Gambar Langkah</label>
              <input type="file" class="form-control rounded-0 cooking-step-image" 
                name="cooking_steps[${cookingStepIndex}][image]" accept="image/*">
            </div>
            <div class="col-md-3 d-flex align-items-end">
              <button type="button" class="btn btn-danger btn-sm remove-cooking-step w-100">
                <i class="ri-delete-bin-line"></i>
                Hapus
              </button>
            </div>
          </div>
        </div>
      `;

            container.insertAdjacentHTML('beforeend', stepHtml);
            cookingStepIndex++;
            updateCookingStepButtons();
        }

        // Remove cooking step
        document.addEventListener('click', function(e) {
            if (e.target.closest('.remove-cooking-step')) {
                e.target.closest('.cooking-step-item').remove();
                updateCookingStepButtons();
            }
        });

        function updateCookingStepButtons() {
            const steps = document.querySelectorAll('.cooking-step-item');
            steps.forEach((step, index) => {
                const removeBtn = step.querySelector('.remove-cooking-step');
                if (steps.length === 1) {
                    removeBtn.disabled = true;
                } else {
                    removeBtn.disabled = false;
                }
            });
        }

        function resetCookingSteps() {
            const container = document.getElementById('cooking-steps-container');
            container.innerHTML = `
        <div class="cooking-step-item border rounded p-3 mb-3">
          <div class="row g-3">
            <div class="col-md-3">
              <label class="form-label">Judul Langkah</label>
              <input type="text" class="form-control rounded-0" name="cooking_steps[0][title]" 
                placeholder="Langkah 1" value="Langkah 1">
            </div>
            <div class="col-md-2">
              <label class="form-label">Urutan</label>
              <input type="number" class="form-control rounded-0" name="cooking_steps[0][order]" 
                value="1" min="1">
            </div>
            <div class="col-md-4">
              <label class="form-label">Gambar Langkah</label>
              <input type="file" class="form-control rounded-0 cooking-step-image" 
                name="cooking_steps[0][image]" accept="image/*">
            </div>
            <div class="col-md-3 d-flex align-items-end">
              <button type="button" class="btn btn-danger btn-sm remove-cooking-step w-100" disabled>
                <i class="ri-delete-bin-line"></i>
                Hapus
              </button>
            </div>
            <div class="col-12">
              <label class="form-label">Deskripsi Langkah</label>
              <textarea class="form-control rounded-0" name="cooking_steps[0][text]" 
                rows="3" placeholder="Jelaskan langkah memasak..."></textarea>
            </div>
          </div>
        </div>
      `;
        }

        // Ingredient Types Management
        document.getElementById('add-ingredient-type').addEventListener('click', function() {
            addIngredientType();
        });

        function addIngredientType() {
            const container = document.getElementById('ingredient-types-container');
            const typeHtml = `
        <div class="ingredient-type-item border rounded p-3 mb-3">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="d-flex align-items-center gap-2">
              <input type="text" class="form-control form-control-sm" name="ingredient_types[${ingredientTypeIndex}][name]" 
                placeholder="Nama kategori (contoh: Bumbu Halus)" style="width: 200px;">
              <button type="button" class="btn btn-sm btn-danger remove-ingredient-type">
                <i class="ri-delete-bin-line"></i>
                Hapus Kategori
              </button>
            </div>
            <button type="button" class="btn btn-sm btn-success add-ingredient">
              <i class="ri-add-line"></i>
              Tambah Bahan
            </button>
          </div>
          <div class="ingredients-container">
            <div class="ingredient-item row g-2 mb-2 align-items-center">
              <div class="col-md-10">
                <input type="text" class="form-control form-control-sm rounded-0" 
                  name="ingredient_types[${ingredientTypeIndex}][ingredients][0][description]" 
                  placeholder="Deskripsi bahan">
              </div>
              <div class="col-md-1">
                <button type="button" class="btn btn-sm btn-danger remove-ingredient w-100" disabled>
                  <i class="ri-delete-bin-line"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
      `;

            container.insertAdjacentHTML('beforeend', typeHtml);
            ingredientTypeIndex++;
        }

        // Remove ingredient type
        document.addEventListener('click', function(e) {
            if (e.target.closest('.remove-ingredient-type')) {
                e.target.closest('.ingredient-type-item').remove();
            }
        });

        // Add ingredient to a category
        document.addEventListener('click', function(e) {
            if (e.target.closest('.add-ingredient')) {
                const ingredientType = e.target.closest('.ingredient-type-item');
                const container = ingredientType.querySelector('.ingredients-container');
                const typeIndex = Array.from(document.querySelectorAll('.ingredient-type-item')).indexOf(
                    ingredientType);
                const ingredientIndex = container.querySelectorAll('.ingredient-item').length;

                const ingredientHtml = `
          <div class="ingredient-item row g-2 mb-2 align-items-center">
            <div class="col-md-10">
              <input type="text" class="form-control form-control-sm rounded-0" 
                name="ingredient_types[${typeIndex}][ingredients][${ingredientIndex}][description]" 
                placeholder="Deskripsi bahan">
            </div>
            <div class="col-md-1">
              <button type="button" class="btn btn-sm btn-danger remove-ingredient w-100">
                <i class="ri-delete-bin-line"></i>
              </button>
            </div>
          </div>
        `;

                container.insertAdjacentHTML('beforeend', ingredientHtml);
                updateIngredientButtons(ingredientType);
            }
        });

        // Remove ingredient
        document.addEventListener('click', function(e) {
            if (e.target.closest('.remove-ingredient')) {
                const ingredientType = e.target.closest('.ingredient-type-item');
                e.target.closest('.ingredient-item').remove();
                updateIngredientButtons(ingredientType);
            }
        });

        function updateIngredientButtons(ingredientType) {
            const ingredients = ingredientType.querySelectorAll('.ingredient-item');
            ingredients.forEach((ingredient, index) => {
                const removeBtn = ingredient.querySelector('.remove-ingredient');
                if (ingredients.length === 1) {
                    removeBtn.disabled = true;
                } else {
                    removeBtn.disabled = false;
                }
            });
        }

        function resetIngredientTypes() {
            const container = document.getElementById('ingredient-types-container');
            container.innerHTML = `
        <div class="ingredient-type-item border rounded p-3 mb-3">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h6 class="mb-0 text-primary">Bahan Utama</h6>
            <button type="button" class="btn btn-sm btn-success add-ingredient">
              <i class="ri-add-line"></i>
              Tambah Bahan
            </button>
          </div>
          <input type="hidden" name="ingredient_types[0][name]" value="Bahan Utama">
          <div class="ingredients-container">
            <div class="ingredient-item row g-2 mb-2 align-items-center">
              <div class="col-md-10">
                <input type="text" class="form-control form-control-sm rounded-0" 
                  name="ingredient_types[0][ingredients][0][description]" 
                  placeholder="Deskripsi bahan (contoh: 5 buah kulit pisang cavendis)">
              </div>
              <div class="col-md-1">
                <button type="button" class="btn btn-sm btn-danger remove-ingredient w-100" disabled>
                  <i class="ri-delete-bin-line"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
      `;
        }

        // Initialize button states
        updateCookingStepButtons();
        document.querySelectorAll('.ingredient-type-item').forEach(updateIngredientButtons);
    </script>
@endpush
