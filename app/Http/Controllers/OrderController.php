<?php

namespace App\Http\Controllers;

use App\Food;
use App\Order;
use Exception;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index(Request $request){
        try{
            // Get orders
            $orders = Order::statecurrent($request->filter)->with('foods')->paginate(20)->toArray();
            return response()->json($orders, 200);
        }catch(Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function create(){
        try{
            // Get random food
            $food = Food::orderByRaw('random()')->first();

            // Generate order
            $order = Order::create([ 'food_id'=>$food->id,'state'=> 'cooking',]);

            // Response
            return response()->json([
                'code' => $order->id,  // Identify the order
                'food' => $food->name,
                'img'  => $food->img
            ], 200);
        }catch(Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

}
