<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('description')->nullable();
            $table->decimal('price', 15, 2)->nullable();
            $table->string('product_name')->nullable();
            $table->decimal('gst', 15, 2)->nullable();
            $table->decimal('final_price', 15, 2)->nullable();
            $table->string('hsn_code')->nullable();
            $table->decimal('offer_price', 15, 2)->nullable();
            $table->string('product_status')->nullable();
            $table->integer('stock')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
