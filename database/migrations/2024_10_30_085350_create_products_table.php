<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('supplier_price', 8, 2);
            $table->decimal('price', 10, 2);
            $table->integer('quantity')->default(0);
            $table->integer('sold')->default(0);
            $table->timestamps();
        });
    }
    


    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
