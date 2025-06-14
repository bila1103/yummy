<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
  protected $fillable = [
    'category_id',
    'user_id',
    'title',
    'slug',
    'image',
    'description',
    'rating',
    'video_url',
    'price',
    'price_premium',
    'calories',
    'is_cvc',
    'cooking_time',
    'serving_min',
    'serving_max',
    'is_bookmark',
    'is_editorial',
    'rating_user',
    'is_video',
    'premium_content',
    'brand_slug',
    'meta_title',
    'meta_description',
    'og_caption',
    'og_title',
    'og_description',
    'og_media',
    'cooking_step',
    'ingredient_type',
  ];

  protected $casts = [
    'cooking_step' => 'array',
];

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function foodTags()
  {
    return $this->belongsToMany(FoodTag::class, 'recipe_tags', 'recipe_id', 'food_tag_id');
  }

  public function ingredients()
  {
    return $this->belongsToMany(Ingredient::class, 'recipe_ingredients', 'recipe_id', 'ingredient_id');
  }

  public function foodInfos()
{
    return $this->belongsToMany(FoodInfo::class, 'recipe_infos', 'recipe_id', 'food_info_id');
}
}
