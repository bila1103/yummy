<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FoodInfoController;
use App\Http\Controllers\FoodTagController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebController;

// Auth Route
Route::prefix('auth')->controller(AuthController::class)->group(function () {
  Route::get('/register','show')->name('register');
  Route::post('/register','register')->name('register.submit');
  Route::get('/', fn() => redirect()->route('login'));
  Route::get('/login', 'login')->name('login');
  Route::post('/login', 'authenticate');
  Route::post('/logout', 'logout')->name('logout');
});

// Dashboard Route
Route::prefix('dashboard')->middleware('auth')->group(function () {
  Route::get('', [DashboardController::class, 'index'])->name('dashboard');

  // Recipe
  Route::prefix('recipe')->controller(RecipeController::class)->group(function () {
    Route::get('', 'index')->name('dashboard.recipe.index');
    Route::get('create', 'create')->name('dashboard.recipe.create');
    Route::post('store', 'store')->name('dashboard.recipe.store');
    Route::get('{id}/edit', 'edit')->name('dashboard.recipe.edit');
    Route::get('{id}', 'show')->name('dashboard.recipe.show');
    Route::put('{id}/update', 'update')->name('dashboard.recipe.update');
    Route::delete('{id}/delete', 'destroy')->name('dashboard.recipe.destroy');
    Route::post('{id}/favorite', 'favorite')->name('dashboard.recipe.favorite');
  });

  // Food Tag
  Route::prefix('food-tag')
    ->middleware('role:admin')
    ->controller(FoodTagController::class)->group(function () {
      Route::get('', 'index')->name('dashboard.food-tag.index');
      Route::get('create', 'create')->name('dashboard.food-tag.create');
      Route::post('store', 'store')->name('dashboard.food-tag.store');
      Route::get('{foodTag}/edit', 'edit')->name('dashboard.food-tag.edit');
      Route::put('{foodTag}/update', 'update')->name('dashboard.food-tag.update');
      Route::delete('{foodTag}/delete', 'destroy')->name('dashboard.food-tag.destroy');
    });

  // Food Info
  Route::prefix('food-info')
    ->middleware('role:admin')
    ->controller(FoodInfoController::class)->group(function () {
      Route::get('', 'index')->name('dashboard.food-info.index');
      Route::get('create', 'create')->name('dashboard.food-info.create');
      Route::post('store', 'store')->name('dashboard.food-info.store');
      Route::get('{foodInfo}/edit', 'edit')->name('dashboard.food-info.edit');
      Route::put('{foodInfo}/update', 'update')->name('dashboard.food-info.update');
      Route::delete('{foodInfo}/delete', 'destroy')->name('dashboard.food-info.destroy');
    });

  // Food Ingredient
  Route::prefix('food-ingredient')
    ->controller(IngredientController::class)->group(function () {
      Route::get('', 'index')->name('dashboard.food-ingredient.index');
      Route::get('create', 'create')->name('dashboard.food-ingredient.create');
      Route::post('store', 'store')->name('dashboard.food-ingredient.store');
      Route::get('{ingredient}/edit', 'edit')->name('dashboard.food-ingredient.edit');
      Route::put('{ingredient}/update', 'update')->name('dashboard.food-ingredient.update');
      Route::delete('{ingredient}/delete', 'destroy')->name('dashboard.food-ingredient.destroy');
    });

  // Profile
  Route::prefix('profile')->controller(UserController::class)->group(function () {
    Route::get('', 'profile_index')->name('dashboard.profile.index');
    Route::put('', 'profile_update')->name('dashboard.profile.update');
    Route::put('updatepassword', 'profile_updatepassword')->name('dashboard.profile.updatepassword');
    Route::put('updatephoto', 'profile_updatephoto')->name('dashboard.profile.updatephoto');
    Route::delete('deletephoto', 'profile_deletephoto')->name('dashboard.profile.deletephoto');
  });
});

// Website Route
Route::controller(WebController::class)->group(function () {
  Route::get('/', 'index')->name('home');
  Route::get('/resep', 'allRecipes')->name('all.recipes');
  Route::get('/resep/users', 'recipeCreators')->name('user.recipes.all');
  Route::get('/resep/{slug}', 'detail')->name('detail');
  Route::get('/resep-terpopuler', 'resep_populer')->name('resep-terpopuler');
  Route::get('/resep-terbaru', 'resep_terbaru')->name('resep-terbaru');
  Route::get('/resep-terfavorit', 'resep_terfavorit')->name('resep-terfavorit');
  Route::get('/resep-teruji', 'resep_teruji')->name('resep-teruji');
  Route::get('/kategori/{slug}', 'kategori')->name('kategori');
  Route::get('/bahan-makanan', 'ingredient_filter')->name('bahan-makanan');
  Route::post('/filter-resep-bahan', 'filterByIngredients')->name('filter.resep.bahan');
  Route::get('/resep/user/{username}', 'userRecipes')->name('user.recipes');
});
