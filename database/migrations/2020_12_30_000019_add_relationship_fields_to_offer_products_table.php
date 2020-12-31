<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToOfferProductsTable extends Migration
{
    public function up()
    {
        Schema::table('offer_products', function (Blueprint $table) {
            $table->unsignedBigInteger('offer_product_id');
            $table->foreign('offer_product_id', 'offer_product_fk_2878960')->references('id')->on('products');
        });
    }
}
