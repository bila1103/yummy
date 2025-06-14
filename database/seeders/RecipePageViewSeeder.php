<?php

namespace Database\Seeders;

use App\Models\Recipe;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RecipePageViewSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $recipesJSON = file_get_contents(resource_path('json/recipes.json'));
    $recipes = json_decode($recipesJSON, true)['data']['recipes'];

    foreach ($recipes as $recipe) {
      $data = Recipe::where('slug', $recipe['slug'])->first();

      if ($data) {
        $data->visited_count = $recipe['visited_count'] ?? 0;
        $data->save();
      }
    }
  }
}
