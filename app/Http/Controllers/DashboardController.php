<?php

namespace App\Http\Controllers;

use App\Models\FoodTag;
use App\Models\Ingredient;
use App\Models\Recipe;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
  public function index()
  {
    $userID = auth()->user()->id;
    $countRecipes = Recipe::where('user_id', $userID)->count(); //menghitung resep milik user tertentu
    $countIngredients = Ingredient::count();
    $countTags = FoodTag::count();
    $avgRating = Recipe::where('user_id', $userID)
      ->avg('rating');
    // Query untuk menghitung resep milik user tertentu -> SELECT COUNT(*) FROM recipes WHERE user_id = $userID;
    // Query untuk menghitung total bahan -> SELECT COUNT(*) FROM ingredients;
    // Query untuk menghitung total tag -> SELECT COUNT(*) FROM food_tags;
    // Query untuk menghitung rata-rata rating resep milik user -> SELECT AVG(rating) FROM recipes WHERE user_id = $userID;
    if ($avgRating === null) {$avgRating = 0;} 
    else { $avgRating = round($avgRating, 2);}
    $this->data['dashboards'] = [
      'Your Recipes' => [
        'count' => $countRecipes,
        'icon' => 'ri-restaurant-line',
        'url' => route('dashboard.recipe.index'),
      ],
      'Ingredients' => [
        'count' => $countIngredients,
        'icon' => 'ri-bowl-line',
        'url' => route('dashboard.food-ingredient.index'),
      ],
      'Tags' => [
        'count' => $countTags,
        'icon' => 'ri-price-tag-3-line',
        'url' => route('dashboard.food-tag.index'),
      ],
      'Your Recipe Ratings (AVG)' => [
        'count' => $avgRating,
        'icon' => 'ri-star-line',
        'url' => '',
      ],
    ];
    $this->data['recentRecipes'] = Recipe::where('user_id', $userID)
      ->orderBy('created_at', 'desc')
      ->take(5)
      ->get();
    // Query untum menampilkan 5 resep terbaru -> SELECT * FROM recipes WHERE user_id = $userID ORDER BY created_at DESC LIMIT 5;
    $this->data['mostViewedRecipes'] = Recipe::select('id', 'title', 'visited_count')
      ->where('user_id', $userID)
      ->orderBy('visited_count', 'desc')
      ->take(5)
      ->get();
    //  Query untuk menampilkan id judul dan kunjuangan -> SELECT id, title, visited_count FROM recipes WHERE user_id = $userID ORDER BY visited_count DESC LIMIT

    $this->data['title'] = 'Dashboard';
    return view('pages.dashboard.index', $this->data);
  }
}
