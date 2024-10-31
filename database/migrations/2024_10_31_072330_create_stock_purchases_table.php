<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockPurchasesTable extends Migration
{
    public function up()
    {
        Schema::create('stock_purchases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->integer('quantity');
            $table->decimal('price', 8, 2);
            $table->decimal('supplier_price', 8, 2);
            $table->timestamps();
        });
        
    }
    

    public function down()
    {
        Schema::dropIfExists('stock_purchases');
    }
}
