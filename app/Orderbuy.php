<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orderbuy extends Model
{
    protected $table = 'orderbuys';

    protected $fillable = [
        'id',
        'order_id',
        'ingredient_id',
        'quantity',
        'asyncquantity',
        'state'
    ];
}
