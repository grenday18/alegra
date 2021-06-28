<?php

namespace App\Observers;

use App\Jobs\Shopping;
use App\Order;
use App\Orderbuy;

class OrderbuyObserver
{
    public function created(Orderbuy $orderbuy){
        Shopping::dispatch( $orderbuy->id,
                            $orderbuy->ingredient_id,
                            $orderbuy->quantity);
    }

    public function updated(Orderbuy $orderbuy){
        $buysComplete = Orderbuy::where('order_id',$orderbuy->order_id)
                                ->where('state','<>','buying')
                                ->count();

        // if ingredients completes
        if($buysComplete >= $orderbuy->asyncquantity){
            $order = Order::find($orderbuy->order_id);
            $order->state = 'complete';
            $order->save();
        }
    }
}
