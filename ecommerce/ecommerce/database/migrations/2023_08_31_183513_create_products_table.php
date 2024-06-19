<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->integer('code');
            $table->string('title');
            $table->mediumText('description');
            $table->string('price');
            $table->string('retail_price')->nullable();
            $table->string('quantity');
            $table->string('wilaya');
            $table->string('category');
            $table->string('phone')->nullable();
            $table->string('brand')->nullable();
            $table->float('size')->nullable();
            // $table->tinyInteger('status')->default('0');
            $table->string('status')->default('Pending');
            $table->date('date');
            $table->text('main_image');
            $table->longText('images')->nullable();
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
