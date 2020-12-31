<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToProductsTable extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedBigInteger('catid_id')->nullable();
            $table->foreign('catid_id', 'catid_fk_2878853')->references('id')->on('product_categories');
            $table->unsignedBigInteger('subcatid_id')->nullable();
            $table->foreign('subcatid_id', 'subcatid_fk_2878854')->references('id')->on('sub_categories');
        });
    }
}
