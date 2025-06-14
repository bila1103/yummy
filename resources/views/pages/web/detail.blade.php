@extends('layouts.web')

@section('content')
    <div class="container-fluid py-5">
        <x-detail.recipe-detail-section :recipe="$recipe" />
        <x-detail.category-section :categories="$recipe->foodTags" />
        <div class="container">
        <x-landing.favorite-section :favorites="$favorites"/>   
        </div>
        <x-detail.related-recipes-section :relatedRecipes="$related_recipes" />
        <x-detail.related-categories-section :relatedCategories="$categories_recipes" />
    </div>  
@endsection
