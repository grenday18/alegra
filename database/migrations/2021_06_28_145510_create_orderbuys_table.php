<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderbuysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orderbuys', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ingredient_id')->nullable()->references('id')->on('ingredients');
            $table->foreignId('order_id')->nullable()->references('id')->on('orders');
            $table->integer('quantity');
            $table->string('state',20);
            $table->integer('asyncquantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orderbuys', function (Blueprint $table) {
            $table->dropForeign('orderbuys_ingredient_id_foreign');
            $table->dropForeign('orderbuys_order_id_foreign');
            $table->dropColumn('ingredient_id');
            $table->dropColumn('order_id');
        });
        Schema::dropIfExists('orderbuys');
    }
}
