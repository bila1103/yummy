<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    // User::factory(10)->create();

    self::call([
      // FoodTagSeeder::class,
      RecipeSeeder::class,
      // IngredientSeeder::class,
      // UserSeeder::class,
      FoodTagSeeder::class,

    ]);
  }
}
