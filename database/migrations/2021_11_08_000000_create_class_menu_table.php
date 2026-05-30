<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('class_menu', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('slug')->unique()->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('premium')->nullable();
            $table->string('tags')->nullable();
            $table->unsignedBigInteger('level_id')->nullable();
            $table->string('tools_id')->nullable();
            $table->string('source_url')->nullable();
            $table->string('status', 10)->nullable();
            $table->decimal('price', 12, 2)->nullable();
            $table->integer('discount')->nullable();
            $table->unsignedBigInteger('add_by')->nullable();
            $table->unsignedBigInteger('class_id')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('class_menu');
    }
};
