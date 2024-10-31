<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoldProductHistoriesTable extends Migration
{
    public function up()
    {
        Schema::create('sold_product_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // Foreign key to products table
            $table->integer('quantity_sold'); // Quantity of the product sold
            $table->decimal('sale_price', 10, 2); // Price at which the product was sold
            $table->dateTime('sold_at'); // Date and time of sale
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sold_product_histories');
    }
}
