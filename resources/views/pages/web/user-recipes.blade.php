@extends('layouts.web')

@section('content')
    <div class="container-fluid py-5">
        <div class="container">
          <x-user-recipes.user-recipes-section :user="$user" :recipes="$recipes" :recipesCount="$recipesCount" />
        </div>
    </div>  
@endsection
