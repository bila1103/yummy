@extends('layouts.web')

@section('content')
    <div class="container-fluid py-5">
        <div class="container">
          <x-kategori.breadcrumb-section :breadcrumbs="$breadcrumbs" />
          <x-kategori.category-section :recipes="$recipes"/>
        </div>
    </div>  
@endsection
