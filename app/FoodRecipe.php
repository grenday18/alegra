<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FoodRecipe extends Model
{
    protected $table = 'food_recipes';

    protected $fillable = [
        'id',
        'food_id',
        'ingredient_id',
        'quantity'
    ];
}
