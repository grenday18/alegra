<?php

namespace App\Observers;

use App\Food;
use App\FoodRecipe;
use App\Ingredient;
use App\Order;
use App\Orderbuy;

class OrderObserver
{
    public function created(Order $order){
        // Get the necessary ingredients
        $ingredients = FoodRecipe::select('food_recipes.quantity','ingredients.name','ingredients.stock','ingredients.id')
                                ->where('food_id',$order->food_id)
                                ->join('ingredients','ingredient_id','ingredients.id')
                                ->get();

        // Verify Ingredients in stock
        foreach($ingredients as $ingredient){
                // Generate job for shopping
                $orderbuy = new Orderbuy;
                $orderbuy->order_id      = $order->id;
                $orderbuy->ingredient_id = $ingredient->id;
                $orderbuy->quantity      = $ingredient->quantity;
                $orderbuy->asyncquantity = sizeof($ingredients);
                $orderbuy->state         = 'buying';
                $orderbuy->save();
        }

    }

}
