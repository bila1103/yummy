<?php

use App\Models\Ingredient;
use App\Models\Recipe;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('recipe_ingredients', function (Blueprint $table) {
      $table->foreignIdFor(Recipe::class, 'recipe_id')->constrained()->cascadeOnDelete();
      $table->foreignIdFor(Ingredient::class, 'ingredient_id')->constrained()->cascadeOnDelete();

      $table->unique(['recipe_id', 'ingredient_id'], 'recipe_ingredient_unique');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('recipe_ingredients');
  }
};
