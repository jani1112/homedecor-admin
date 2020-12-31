<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedbackViewsTable extends Migration
{
    public function up()
    {
        Schema::create('feedback_views', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('customerfeedback_email')->nullable();
            $table->longText('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
