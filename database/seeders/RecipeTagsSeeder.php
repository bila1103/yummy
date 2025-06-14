<?php

namespace Database\Seeders;

use App\Models\FoodTag;
use App\Models\Ingredient;
use App\Models\Recipe;
use App\Models\RecipeIngredients;
use App\Models\RecipeTags;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RecipeTagsSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $folderPath = resource_path('json/recipes');
    $files = glob($folderPath . '/*.json');

    foreach ($files as $file) {
      $jsonContent = file_get_contents($file);
      $data = json_decode($jsonContent, true)['data'];

      $recipe = Recipe::where('slug', $data['slug'])->first();

      if (!$recipe) continue;

      if (!empty($data['tags'])) {
        foreach ($data['tags'] as $tag) {
          $tag = FoodTag::where('slug', $tag['slug'])->first();

          if (!$tag) continue;

          RecipeTags::insertOrIgnore([
            'recipe_id' => $recipe->id,
            'food_tag_id' => $tag->id,
          ]);
        }
      }
    }
  }
}
