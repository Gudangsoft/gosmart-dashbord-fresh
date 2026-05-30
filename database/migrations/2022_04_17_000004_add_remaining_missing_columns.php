<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // carts: tambah kolom price
        Schema::table('carts', function (Blueprint $table) {
            $table->decimal('price', 10, 2)->default(0)->after('status');
        });

        // pages_models: tambah kolom status dan type
        Schema::table('pages_models', function (Blueprint $table) {
            $table->string('status')->default('p')->after('content');
            $table->tinyInteger('type')->default(0)->after('status');
        });

        // class_menu: tambah kolom yang mungkin masih kurang
        if (!Schema::hasColumn('class_menu', 'tags')) {
            Schema::table('class_menu', function (Blueprint $table) {
                $table->string('tags')->nullable()->after('description');
            });
        }

        // orders: tambah kolom snap_token jika belum ada
        if (!Schema::hasColumn('orders', 'snap_token')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->string('snap_token')->nullable()->after('payment_status');
            });
        }
    }

    public function down(): void
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->dropColumn('price');
        });
        Schema::table('pages_models', function (Blueprint $table) {
            $table->dropColumn(['status', 'type']);
        });
    }
};
