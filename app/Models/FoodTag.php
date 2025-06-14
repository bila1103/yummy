<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FoodTag extends Model
{
  protected $fillable = [
    'name',
    'description',
    'slug'
  ];
  public function recipes()
  {
    return $this->belongsToMany(Recipe::class, 'recipe_tags', 'food_tag_id', 'recipe_id');
  }
}
