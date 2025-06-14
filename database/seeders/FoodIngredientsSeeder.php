<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use App\Models\Recipe;
use App\Models\RecipeIngredients;
use App\Models\RecipeTags;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FoodIngredientsSeeder extends Seeder
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

      if (!$recipe) {
        continue; // Skip if recipe not found
      }

      if (!empty($data['tag_ingredients'])) {
        foreach ($data['tag_ingredients'] as $ingredient) {
          $ingredient = Ingredient::where('slug', $ingredient['slug'])->first();

          if (!$ingredient) {
            continue; // Skip if ingredient not found
          }

          RecipeIngredients::insertOrIgnore(
            [
              'recipe_id' => $recipe->id,
              'ingredient_id' => $ingredient->id,
            ]
          );
        }
      }
    }
  }
}
