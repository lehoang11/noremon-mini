<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id');
            $table->string('name');
            $table->string('slug');
            $table->string('image')->nullable();
            $table->double('util_price', 8, 2);
            $table->double('price_sale', 8, 2);
            $table->text('content')->nullable();
            $table->text('description')->nullable();
            $table->tinyInteger('status')->unsigned()->default(0);
            $table->integer('view')->unsigned()->nullable();
            $table->tinyInteger('hot')->unsigned()->default(0);
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
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
        Schema::dropIfExists('products');
    }
}
