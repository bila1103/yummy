<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FoodInfo extends Model
{
  protected $table = 'food_infos';
  protected $guarded = [];

  public function recipes()
  {
    return $this->belongsToMany(Recipe::class, 'recipe_infos', 'food_info_id', 'recipe_id');
  }
}
