<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecipeInfo extends Model
{
  protected $table = 'recipe_infos';

  public $timestamps = false;

  protected $fillable = [
    'recipe_id',
    'food_info_id'
  ];

  public function recipe()
  {
    return $this->belongsTo(Recipe::class);
  }

  public function foodInfo()
  {
    return $this->belongsTo(FoodInfo::class);
  }
}
