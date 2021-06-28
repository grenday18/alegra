<?php

namespace App\Observers;

use App\Food;
use App\FoodRecipe;
use App\Ingredient;
use App\Order;

class OrderObserver
{
    public function created(Order $order){
        // Get the necessary ingredients
        $ingredients = FoodRecipe::select('food_recipes.quantity','ingredients.name','ingredients.stock','ingredients.id')
                                ->where('food_id',$order->food_id)
                                ->join('ingredients','ingredient_id','ingredients.id')
                                ->get();

        $ingredientsComplete = true;

        // Verify Ingredients in stock
        foreach($ingredients as $ingredient){
            if($ingredient->stock < $ingredient->quantity){
                // Generate job for shopping
                $ingredientsComplete = false;
            }
        }

        // Preparate Food
        if($ingredientsComplete){
            foreach($ingredients as $ingredient){
                $model        = Ingredient::find($ingredient->id);
                $model->stock = $ingredient->stock - $ingredient->quantity;
                $model->save();
            }
        }

        // Update State food
        $order = Order::find($order->id);
        $order->state = 'complete';
        $order->save();
    }

}
