<?php

use App\Models\FoodInfo;
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
    Schema::create('recipe_infos', function (Blueprint $table) {
      $table->foreignIdFor(Recipe::class, 'recipe_id')->constrained()->cascadeOnDelete();
      $table->foreignIdFor(FoodInfo::class, 'food_info_id')->constrained()->cascadeOnDelete();

      $table->unique(['recipe_id', 'food_info_id'], 'recipe_food_unique');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('recipe_infos');
  }
};
