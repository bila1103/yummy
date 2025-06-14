<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IsVerifiedUserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $recipesJSON = file_get_contents(resource_path('json/recipes.json'));
    $recipes = json_decode($recipesJSON, true)['data']['recipes'];

    foreach ($recipes as $recipe) {
      $data = User::where('username', $recipe['author']['username'])->first();

      if ($data) {
        $data->is_verified = $recipe['author']['is_official'] == true ? 1 : 0;
        $data->save();
      }
    }
  }
}
