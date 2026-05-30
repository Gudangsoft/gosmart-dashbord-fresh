<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('view_stream', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user')->nullable();
            $table->string('slug')->nullable();
            $table->unsignedBigInteger('chanel_id')->nullable();
            $table->string('class_id')->nullable();
            $table->text('link')->nullable();
            $table->string('judul')->nullable();
            $table->text('keterangan')->nullable();
            $table->tinyInteger('premium')->default(0);
            $table->string('status')->nullable();
            $table->unsignedBigInteger('level')->nullable();
            $table->string('gambar')->nullable();
            $table->string('kategori')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('view_stream');
    }
};
