<?php

use App\Models\FoodTag;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::create('recipes', function (Blueprint $table) {
      $table->id();
      $table->string('title');
      $table->foreignIdFor(FoodTag::class, 'category_id')->nullable()->constrained()->nullOnDelete();
      $table->foreignIdFor(User::class, 'user_id')->nullable()->constrained()->nullOnDelete();
      $table->string('slug')->unique();
      $table->string('image')->nullable();
      $table->text('description')->nullable();
      $table->smallInteger('rating')->default(0);
      $table->string('video_url')->nullable();
      $table->bigInteger('price')->default(0);
      $table->bigInteger('price_premium')->default(0);
      $table->string('calories')->nullable();
      $table->boolean('is_cvc')->default(false);
      $table->integer('cooking_time')->default(0);
      $table->integer('serving_min')->default(0);
      $table->integer('serving_max')->default(0);
      $table->boolean('is_bookmark')->default(false);
      $table->boolean('is_editorial')->default(false);
      $table->smallInteger('rating_user')->default(0);
      $table->boolean('is_video')->default(false);
      $table->boolean('premium_content')->default(false);
      $table->string('brand_slug')->nullable();
      $table->string('meta_title')->nullable();
      $table->string('meta_description')->nullable();
      $table->string('og_caption')->nullable();
      $table->string('og_title')->nullable();
      $table->string('og_description')->nullable();
      $table->string('og_media')->nullable();
      $table->string('share_link')->nullable();
      $table->string('category_name')->nullable();
      $table->timestamp('release_date')->nullable();
      $table->timestamp('updated_date');
      $table->json('cooking_step')->nullable();
      $table->json('ingredient_type')->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('recipes');
  }
};
