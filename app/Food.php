<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $table = 'foods';

    protected $fillable = [
        'id',
        'name',
        'img'
    ];

    public function ingredients(){
        return $this->belongsToMany(Ingredient::class,'food_recipes','food_id','ingredient_id');
    }
}
