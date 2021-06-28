<?php

namespace App\Http\Controllers;

use App\Ingredient;
use Exception;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    public function index(Request $request){
        try{
            // Get orders
            $ingredients = Ingredient::paginate(20)->toArray();
            return response()->json($ingredients, 200);
        }catch(Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
