<?php

namespace Database\Seeders;

use App\Models\FoodInfo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FoodInfoSeeder extends Seeder
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

    $recipeInfos = collect();

    foreach ($files as $file) {
      $json = file_get_contents($file);
      $data = json_decode($json, true)['data'];

      $recipeInfo = empty($data['recipe_info']) ? null : $data['recipe_info'];
      if ($recipeInfo == null) continue;

      foreach ($recipeInfo as $value) {
        $recipeInfos->push([
          'name' => trim($value['name']),
          'slug' => trim($value['slug']),
        ]);
      }
    }

    $recipeInfos = $recipeInfos->unique('slug')->values();

    foreach ($recipeInfos as $recipeInfo) {
      FoodInfo::updateOrCreate(
        ['slug' => $recipeInfo['slug']],
        ['name' => $recipeInfo['name']]
      );
    }
  }
}
