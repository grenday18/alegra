<?php

namespace App\Http\Controllers;

use App\Orderbuy;
use Exception;
use Illuminate\Http\Request;

class OrderbuyController extends Controller
{
        
    public function purchases(Request $request){
        try{
            // Get purchases
            $purchases = Orderbuy::Select('ingredients.name as ingredient','orderbuys.order_id','orderbuys.quantity','orderbuys.updated_at as date')
                                ->where('state','bought')
                                ->join('ingredients','orderbuys.ingredient_id','ingredients.id')
                                ->orderByDesc('orderbuys.id')
                                ->paginate(20)->toArray();
            return response()->json($purchases, 200);
        }catch(Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

}
