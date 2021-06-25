<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodRecipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('food_recipes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('food_id')->nullable()->references('id')->on('foods');
            $table->foreignId('ingredient_id')->nullable()->references('id')->on('ingredients');
            $table->integer('quantity');
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
        Schema::table('food_recipes', function (Blueprint $table) {
            $table->dropForeign('food_recipes_food_id_foreign');
            $table->dropForeign('food_recipes_ingredient_id_foreign');
            $table->dropColumn('food_id');
            $table->dropColumn('ingredient_id');
        });
        Schema::dropIfExists('food_recipes');
    }
}
