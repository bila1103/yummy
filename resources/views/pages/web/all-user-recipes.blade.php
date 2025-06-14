@extends('layouts.web')

@section('content')
    <div class="container-fluid py-5">
        <div class="container">
          <x-user-recipes.all-user-recipes-section :creators="$creators"/>
        </div>
    </div>  
@endsection
