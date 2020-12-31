<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToFeaturedProductsTable extends Migration
{
    public function up()
    {
        Schema::table('featured_products', function (Blueprint $table) {
            $table->unsignedBigInteger('featured_product_id');
            $table->foreign('featured_product_id', 'featured_product_fk_2878878')->references('id')->on('products');
        });
    }
}
