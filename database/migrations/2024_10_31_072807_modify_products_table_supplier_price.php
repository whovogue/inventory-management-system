<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyProductsTableSupplierPrice extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            // To make it nullable
            $table->decimal('supplier_price', 8, 2)->nullable()->change();
            // OR to set a default value
            // $table->decimal('supplier_price', 8, 2)->default(0)->change();
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            // Reverting the change (make it not nullable if you made it nullable)
            $table->decimal('supplier_price', 8, 2)->nullable(false)->change();
        });
    }
}
