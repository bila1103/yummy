@extends('layouts.web')

@section('content')
  <x-landing.carousel-section />
  <div class="container-fluid"> 
    <x-landing.story-section :stories="$stories" />
    <x-landing.favorite-section :favorites="$favorites"/>
    <x-landing.today-menu-section :todayMenus="$todayMenus" />
    <x-landing.ingredients-by-category-section :ingredients="$ingredients" />
    <x-landing.premium-recipes-section :premiumRecipes="$premiumRecipes" />
    <x-landing.official-accounts-section  :officialAccounts="$officialAccounts"/>
    {{-- <x-landing.latest-recooks-section /> --}}
    <x-landing.yummy-friend-recipes-section :yummyRecipes="$yummyRecipes" />
    <x-landing.healthy-dished-section  :healthyDishes="$healthyDishes"/>
    <x-landing.simple-dishes-section :simpleDishes="$simpleDishes" />
  </div>
@endsection
