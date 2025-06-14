<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
  protected $table = 'ingredients';
  protected $fillable = [
    'name',
    'slug',
    'image_url',
  ];

  public function recipes()
  {
    return $this->belongsToMany(Recipe::class, 'recipe_ingredients', 'ingredient_id', 'recipe_id');
  }
}
