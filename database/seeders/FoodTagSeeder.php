<?php

namespace Database\Seeders;

use App\Models\FoodTag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FoodTagSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $folder_path = resource_path('json/recipes');
    $files = glob($folder_path . '/*.json');

    $tags = collect();

    foreach ($files as $file) {
      $json = file_get_contents($file);
      $data = json_decode($json, true);

      if (isset($data['data']['tags'])) {
        foreach ($data['data']['tags'] as $tag) {
          $tags->push([
            'name' => $tag['name'],
            'slug' => $tag['slug'],
            'created_at' => now(),
            'updated_at' => now(),
          ]);
        }
      }
    }

    $tags = $tags->unique('slug');

    FoodTag::insert($tags->toArray());
  }
}
