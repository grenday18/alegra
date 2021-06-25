<?php

use App\Ingredient;
use Illuminate\Database\Seeder;

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ingredients = [
            'tomato',
            'lemon',
            'potato',
            'rice',
            'ketchup',
            'lettuce',
            'onion',
            'cheese',
            'meat',
            'chicken',
        ];
        foreach($ingredients as $ingredient){
            $modelIngredient = new Ingredient;
            $modelIngredient->name = $ingredient;
            $modelIngredient->stock = 5;
            $modelIngredient->save();
        }
    }
}
