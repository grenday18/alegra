<?php

namespace App\Jobs;

use App\Ingredient;
use App\Order;
use App\Orderbuy;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class Shopping implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $orderbuy_id;
    protected $ingredient_id;
    protected $quantity;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($orderbuy_id,$ingredient_id,$quantity)
    {
        $this->orderbuy_id   = $orderbuy_id;
        $this->ingredient_id = $ingredient_id;
        $this->quantity      = $quantity;
    }

        /**
         * Execute the job.
         *
         * @return void
         */
    public function handle()
    {
        $ingredient = Ingredient::find($this->ingredient_id);
        // Buy Ingredient in market
        $buy = 0;
        while( ($ingredient->stock + $buy ) < $this->quantity){
            $buy = $buy + $this->buyIngredient($ingredient->name);
        }
        $ingredient->stock = $ingredient->stock + $buy - $this->quantity;
        $ingredient->save();
        
        $orderbuy = Orderbuy::find($this->orderbuy_id);
        if($buy == 0)
            $orderbuy->state = 'got';
        else{
            $orderbuy->state = 'bought';
            $orderbuy->quantity = $buy;
        }
        $orderbuy->save();

    }

    private function buyIngredient($ingredient){
        sleep(10);
        return rand(0,5);
        // try{
        //     // $token = 'basic ';
        //     $url = 'http://ingeservicios.com.pe/api/market/'.$ingredient;
        //     $data = file_get_contents($url);
        //     $response = json_decode($data, true);
        //     return $response['quantity'];
        // }
        // catch(Exception $e){
        //     return 0;
        // }
    }

}
