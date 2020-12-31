<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('product_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('category_code')->nullable()->unique();
            $table->string('category_name')->nullable();
            $table->string('category_status')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
