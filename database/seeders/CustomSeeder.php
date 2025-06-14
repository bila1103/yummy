<?php

namespace Database\Seeders;

use App\Models\FoodInfo;
use App\Models\Recipe;
use App\Models\RecipeInfo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $folderPath = resource_path('json/recipes');
    $files = glob($folderPath . '/*.json');

    $folderPath2 = resource_path('json/recipespremium');
    $files2 = glob($folderPath2 . '/*.json');

    $files = array_merge($files, $files2);

    foreach ($files as $file) {
      $json = file_get_contents($file);
      $data = json_decode($json, true)['data'];

      $recipeSlug = $data['slug'] ?? null;
      if (!$recipeSlug) continue;

      $recipe = Recipe::where('slug', $recipeSlug)->first();
      if (!$recipe) continue;

      $recipeId = $recipe->id;

      $recipeInfos = $data['recipe_info'];
      if (empty($recipeInfos)) continue;

      foreach ($recipeInfos as $recipeInfo) {
        $slug = $recipeInfo['slug'];
        if (!$slug) continue;

        $foodInfo = FoodInfo::where('slug', $slug)->first();
        if (!$foodInfo) continue;
        $foodInfoId = $foodInfo->id;

        RecipeInfo::create([
          'recipe_id' => $recipeId,
          'food_info_id' => $foodInfoId
        ]);
      }
    }
  }
}
