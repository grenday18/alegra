<?php

use App\Food;
use App\FoodRecipe;
use Illuminate\Database\Seeder;

class FoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1| Lomo saltado 
        $food = new Food();
        $food->name = 'Lomo Saltado';
        $food->img = '';
        $food->save();

        $ingredients = [4,3,9];
        $quantities = [2,1,2];

        $this->createFoodRecipe($ingredients,$food->id,$quantities);

        // 2| Arroz con pollo frito
        $food = new Food();
        $food->name = 'Arroz con pollo frito';
        $food->img = '';
        $food->save();

        $ingredients = [1,2,3,4,6,10];
        $quantities = [1,1,1,1,1,2];

        $this->createFoodRecipe($ingredients,$food->id,$quantities);
        
        // 3| Ensalada de pollo asado
        $food = new Food();
        $food->name = 'Ensalada de pollo asado';
        $food->img = '';
        $food->save();

        $ingredients = [1,2,5,6,8];
        $quantities = [3,2,1,2,1];

        $this->createFoodRecipe($ingredients,$food->id,$quantities);

        // 3| Patatas a lo pobre con cebolla
        $food = new Food();
        $food->name = 'Patatas a lo pobre con cebolla';
        $food->img = '';
        $food->save();

        $ingredients = [3,7];
        $quantities = [4,2];

        $this->createFoodRecipe($ingredients,$food->id,$quantities);

        // 4| Carne con puré a la italiana
        $food = new Food();
        $food->name = 'Carne con puré a la italiana';
        $food->img = '';
        $food->save();

        $ingredients = [1,3,7,9];
        $quantities = [1,4,2,3];

        $this->createFoodRecipe($ingredients,$food->id,$quantities);

        // 5| Bolitas de patata y queso
        $food = new Food();
        $food->name = 'Bolitas de patata y queso';
        $food->img = '';
        $food->save();

        $ingredients = [3,8];
        $quantities = [4,2];

        $this->createFoodRecipe($ingredients,$food->id,$quantities);

        // 6| Arroz con bistec
        $food = new Food();
        $food->name = 'Arroz con bistec';
        $food->img = '';
        $food->save();

        $ingredients = [1,2,3,4,6,9];
        $quantities = [1,1,1,1,1,2];

        $this->createFoodRecipe($ingredients,$food->id,$quantities);
    }

    private function createFoodRecipe($ingredients,$food_id,$quantities){
        for($i = 0; $i < sizeof($ingredients); $i++){
            $foodRecipe = new FoodRecipe;
            $foodRecipe->food_id = $food_id;
            $foodRecipe->ingredient_id = $ingredients[0];
            $foodRecipe->quantity = $quantities[0]; 
            $foodRecipe->save();
        }
    }
}
