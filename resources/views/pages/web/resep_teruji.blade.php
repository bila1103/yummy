@extends('layouts.web')

@section('content')
    <div class="container-fluid py-5">
        <div class="container">
          <x-resep.breadcrumb-section :breadcrumbs="$breadcrumbs" />
          <x-resep.resep-teruji-section :recipes="$recipes"/>
        </div>
    </div>  
@endsection
