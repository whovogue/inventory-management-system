<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockPurchaseHistoriesTable extends Migration
{
    public function up()
    {
        Schema::create('stock_purchase_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // Foreign key to products
            $table->integer('quantity');
            $table->decimal('price', 8, 2);
            $table->decimal('supplier_price', 8, 2);
            $table->timestamp('purchase_date');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('stock_purchase_histories');
    }
}

