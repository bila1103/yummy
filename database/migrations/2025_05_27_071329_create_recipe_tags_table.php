<?php

use App\Models\FoodTag;
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
    Schema::create('recipe_tags', function (Blueprint $table) {
      $table->foreignIdFor(Recipe::class, 'recipe_id')->constrained()->cascadeOnDelete();
      $table->foreignIdFor(FoodTag::class, 'food_tag_id')->constrained()->cascadeOnDelete();

      $table->unique(['recipe_id', 'food_tag_id'], 'recipe_tag_unique');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('recipe_tags');
  }
};
