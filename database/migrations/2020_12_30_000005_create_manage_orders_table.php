<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManageOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('manage_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('bill_no');
            $table->string('customerid');
            $table->decimal('total_amount', 15, 2);
            $table->string('order_status');
            $table->integer('total_product');
            $table->string('payment_type');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
