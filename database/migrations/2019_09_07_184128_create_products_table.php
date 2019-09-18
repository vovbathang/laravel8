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
            $table->string('name');
            $table->string('code')->unique();
            $table->longText('content');
         //   $table->decimal('regular_price', 10, 2);
            $table->integer('regular_price')->default(0)->unsigned();
            $table->integer('sale_price')->default(0)->unsigned();
            $table->integer('original_price')->default(0)->unsigned();
            $table->integer('quantity')->default(0)->unsigned();
            $table->longText('attributes')->nullable();
            $table->text('image')->nullable();
            $table->integer('user_id')->unsigned();
            $table->integer('category_id')->unsigned();

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
