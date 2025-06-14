@extends('layouts.web')

@section('content')
    <div class="container-fluid py-5">
        <div class="container">
          <x-ingredients.ingredient-by-filter-section :recipes="$recipes" :bahanPopuler="$bahan_populer" :bahanLain="$bahan_lain" />
      </div>
    </div>  
@endsection
