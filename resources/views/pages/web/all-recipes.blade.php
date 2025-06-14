@extends('layouts.web')

@section('content')
    <div class="container-fluid py-5">
        <div class="container">
          <x-resep.recipe-all-section :recipes="$recipes" />
        </div>
    </div>  
@endsection
