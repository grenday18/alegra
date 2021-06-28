<?php

namespace App;

use Dotenv\Loader\Value;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'id',
        'food_id',
        'state'
    ];

    public function foods()
    {
        return $this->belongsTo(Food::class,'food_id');
    }

    public function scopeStatecurrent($query,$state)
    {
        if($state){
            return $query->where('state',$state);
        }
        return $query;
    }
}
