<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewClassModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('review_class_models', function (Blueprint $table) {
            $table->id();
            $table->string('class_id')->nullable();
            $table->string('user_id')->nullable();
            $table->string('rating')->nullable();
            $table->string('review')->nullable();
            $table->string('status', '2')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('review_class_models');
    }
}
