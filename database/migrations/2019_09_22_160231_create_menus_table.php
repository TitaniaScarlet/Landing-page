<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('category_id');
             $table->string('title');
             $table->string('image')->nullable();
             $table->string('slug')->unique();
             $table->string('ingredients')->nullable();
             $table->integer('weight')->nullable();
             $table->integer('quantity')->nullable();
             $table->decimal('price');
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
           Schema::dropIfExists('menus');
    }
}
