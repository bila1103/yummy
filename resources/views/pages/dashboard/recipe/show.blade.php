@extends('layouts.dashboard')
@php
  $breadcrumbs = [
      ['label' => 'Dashboard', 'url' => route('dashboard')],
      ['label' => 'Recipe', 'url' => route('dashboard.recipe.index')],
      ['label' => $recipe->title],
  ];
@endphp

@section('action')
  <div class="d-flex gap-2">
    <a href="{{ route('dashboard.recipe.index') }}" class="btn btn-secondary">
      <i class="ri-arrow-left-line"></i>
      Kembali
    </a>
    <a href="{{ route('dashboard.recipe.edit', $recipe->id) }}" class="btn btn-primary">
      <i class="ri-edit-line"></i>
      Edit
    </a>
  </div>
@endsection

@section('content')
  <div class="col-12 col-lg-10 mx-auto">
    <div class="card my-5">
      <div class="card-header border-bottom d-flex justify-content-between align-items-center">
        <h5 class="mb-0">
          <i class="ri-restaurant-2-line"></i>
          <span class="fw-bold">Detail Recipe</span>
        </h5>
        <span class="badge bg-{{ $recipe->is_active ? 'success' : 'danger' }} rounded-pill">
          {{ $recipe->is_active ? 'Active' : 'Inactive' }}
        </span>
      </div>
      
      <div class="card-body">
        <!-- Recipe Header -->
        <div class="row g-4 mb-4">
          <div class="col-md-5">
            <div class="position-relative h-100" style="min-height: 300px;">
              @if($recipe->image)
                <img src="{{ $recipe->image }}" alt="{{ $recipe->title }}" class="img-fluid rounded-3 w-100 h-100" style="object-fit: cover;">
              @else
                <img src="{{ asset('assets/img/noimage.webp') }}" alt="No Image" class="img-fluid rounded-3 w-100 h-100" style="object-fit: cover;">
              @endif
            </div>
          </div>
          <div class="col-md-7">
            <h3 class="mb-1">{{ $recipe->title }}</h3>
            
            <div class="d-flex flex-wrap mb-3">
              @foreach($recipe->foodTags as $tag)
                <span class="badge bg-warning text-dark me-1 mb-1">{{ $tag->name }}</span>
              @endforeach
            </div>
            
            <div class="mb-3">
              <p class="mb-0">{{ $recipe->description }}</p>
            </div>
            
            <hr>
            
            <div class="row g-3 text-center">
              <div class="col-6 col-md-3">
                <div class="border rounded-3 py-2">
                  <div class="fw-semibold text-primary">
                    <i class="ri-time-line"></i> Waktu
                  </div>
                  <div>{{ $recipe->cooking_time }} menit</div>
                </div>
              </div>
              <div class="col-6 col-md-3">
                <div class="border rounded-3 py-2">
                  <div class="fw-semibold text-primary">
                    <i class="ri-fire-line"></i> Kalori
                  </div>
                  <div>{{ $recipe->calories ?? '-' }} kcal</div>
                </div>
              </div>
              <div class="col-6 col-md-3">
                <div class="border rounded-3 py-2">
                  <div class="fw-semibold text-primary">
                    <i class="ri-group-line"></i> Porsi
                  </div>
                  <div>{{ $recipe->serving_min }} - {{ $recipe->serving_max }}</div>
                </div>
              </div>
              <div class="col-6 col-md-3">
                <div class="border rounded-3 py-2">
                  <div class="fw-semibold text-primary">
                    <i class="ri-money-dollar-circle-line"></i> Harga
                  </div>
                  <div>Rp {{ number_format($recipe->price, 0, ',', '.') }}</div>
                </div>
              </div>
            </div>
            
            <hr>
            
            @if(count($recipe->foodInfos) > 0)
              <div class="mb-3">
                <h6 class="mb-2">Food Info</h6>
                <div class="d-flex flex-wrap">
                  @foreach($recipe->foodInfos as $info)
                    <div class="me-3 mb-2 text-center">
                      <div class="badge bg-warning text-dark px-2 py-1">{{ $info->name }}</div>
                    </div>
                  @endforeach
                </div>
              </div>
            @endif
          </div>
        </div>
        
        <hr class="my-4">
        
        <!-- Ingredients Section -->
        <div class="mb-4">
          <h5 class="mb-3">Bahan-bahan</h5>
          
          @php
            $ingredientTypes = [];
            if (!empty($recipe->ingredient_type)) {
              if (is_string($recipe->ingredient_type)) {
                $ingredientTypes = json_decode($recipe->ingredient_type, true) ?? [];
              } else {
                $ingredientTypes = $recipe->ingredient_type;
              }
            }
          @endphp
          
          @if(!empty($ingredientTypes))
            @foreach($ingredientTypes as $type)
              <div class="card mb-3">
                <div class="card-header bg-light py-2">
                  <h6 class="mb-0">{{ $type['name'] }}</h6>
                </div>
                <div class="card-body">
                  <ul class="list-group list-group-flush">
                    @foreach($type['ingredients'] as $ingredient)
                      <li class="list-group-item px-0 d-flex align-items-center">
                        @if(isset($ingredient['media_url']) && !empty($ingredient['media_url']))
                          <div class="me-2">
                            <img src="https://cdn.yummy.co.id/{{ $ingredient['media_url'] }}" alt="Ingredient" class="rounded" style="width: 32px; height: 32px; object-fit: cover;">
                          </div>
                        @endif
                        <div>
                          {{ $ingredient['description'] }}
                          @if(isset($ingredient['brand']) && !empty($ingredient['brand']))
                            <span class="text-muted"> - {{ $ingredient['brand'] }}</span>
                          @endif
                        </div>
                        @if(isset($ingredient['buy_url']) && !empty($ingredient['buy_url']))
                          <a href="{{ $ingredient['buy_url'] }}" target="_blank" class="ms-auto btn btn-sm btn-outline-primary">
                            <i class="ri-shopping-cart-line"></i>
                            Beli
                          </a>
                        @endif
                      </li>
                    @endforeach
                  </ul>
                </div>
              </div>
            @endforeach
          @else
            <div class="alert alert-info">
              Belum ada bahan yang ditambahkan.
            </div>
          @endif
        </div>
        
        <!-- Cooking Steps Section -->
        <div class="mb-4">
          <h5 class="mb-3">Langkah-langkah Memasak</h5>
          
          @php
            $cookingSteps = [];
            if (!empty($recipe->cooking_step)) {
              if (is_string($recipe->cooking_step)) {
                $cookingSteps = json_decode($recipe->cooking_step, true) ?? [];
              } else {
                $cookingSteps = $recipe->cooking_step;
              }
              
              // Sort by order
              usort($cookingSteps, function($a, $b) {
                return $a['order'] <=> $b['order'];
              });
            }
          @endphp
          
          @if(!empty($cookingSteps))
            <div class="steps-timeline">
              @foreach($cookingSteps as $index => $step)
                <div class="step-item mb-4">
                  <div class="card">
                    <div class="card-header bg-light py-2">
                      <h6 class="mb-0">{{ $step['title'] }}</h6>
                    </div>
                    <div class="card-body">
                      <div class="row">
                        @if(isset($step['image_url']) && !empty($step['image_url']))
                          <div class="col-md-4 mb-3 mb-md-0">
                            <img src="{{ $step['image_url'] }}" alt="Step {{ $step['order'] }}" class="img-fluid rounded">
                          </div>
                          <div class="col-md-8">
                            <p>{{ $step['text'] }}</p>
                          </div>
                        @else
                          <div class="col-12">
                            <p>{{ $step['text'] }}</p>
                          </div>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
          @else
            <div class="alert alert-info">
              Belum ada langkah memasak yang ditambahkan.
            </div>
          @endif
        </div>
        
        <!-- Related Ingredients Section -->
        @if(count($recipe->ingredients) > 0)
          <hr class="my-4">
          
          <div class="mb-4">
            <h5 class="mb-3">Bahan Terkait</h5>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-3">
              @foreach($recipe->ingredients as $ingredient)
                <div class="col">
                  <div class="card h-100">
                    <div class="card-body p-3">
                      <div class="d-flex align-items-center">
                        @if($ingredient->image_url)
                          <div class="me-3">
                            <img src="{{ $ingredient->image_url }}" alt="{{ $ingredient->name }}" class="rounded" style="width: 48px; height: 48px; object-fit: cover;">
                          </div>
                        @endif
                        <div>
                          <h6 class="mb-0">{{ $ingredient->name }}</h6>
                          <small class="text-muted">{{ $ingredient->category ? $ingredient->category->name : '-' }}</small>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        @endif
        
        <!-- Meta Information -->
        <hr class="my-4">
        
        <div class="row g-3">
          <div class="col-md-6">
            <div class="card bg-light">
              <div class="card-body p-3">
                <h6 class="mb-3">Informasi Recipe</h6>
                <table class="table table-sm table-borderless mb-0">
                  <tr>
                    <td width="150"><strong>ID</strong></td>
                    <td>: {{ $recipe->id }}</td>
                  </tr>
                  <tr>
                    <td><strong>Slug</strong></td>
                    <td>: {{ $recipe->slug }}</td>
                  </tr>
                  <tr>
                    <td><strong>Dibuat Pada</strong></td>
                    <td>: {{ $recipe->created_at->format('d M Y H:i') }}</td>
                  </tr>
                  <tr>
                    <td><strong>Diperbarui Pada</strong></td>
                    <td>: {{ $recipe->updated_at->format('d M Y H:i') }}</td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      
    </div>
  </div>
@endsection

@push('styles')
  <style>
    .steps-timeline {
      position: relative;
    }
    
    .steps-timeline::before {
      content: '';
      position: absolute;
      top: 0;
      bottom: 0;
      left: 20px;
      width: 3px;
      background-color: #e9ecef;
      z-index: -1;
    }
    
    .step-item {
      padding-left: 45px;
      position: relative;
    }
    
    .step-item::before {
      content: '';
      position: absolute;
      left: 10px;
      top: 15px;
      width: 20px;
      height: 20px;
      border-radius: 50%;
      background-color: #fff;
      border: 3px solid #6c757d;
      z-index: 1;
    }
    
    .step-item:first-child::before {
      border-color: #28a745;
    }
    
    .step-item:last-child::before {
      border-color: #dc3545;
    }
  </style>
@endpush