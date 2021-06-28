<?php

namespace App\Http\Controllers;

use App\Food;
use App\FoodRecipe;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    public function index(){
        $foods = Food::all();
        if($foods){
            return response()->json($foods, 200);
        }
        return response()->json(['error'=>'No data found'], 500);
    }

    public function show($id){
        $food = Food::find($id);
        if($food){
            $food['ingredients'] = FoodRecipe::select('food_recipes.quantity','ingredients.name')
                                        ->where('food_id',$id)
                                        ->join('ingredients','ingredient_id','ingredients.id')
                                        ->get();
            return response()->json($food, 200);
        }
        return response()->json(['error'=>'No data found'], 500);
    }
}
