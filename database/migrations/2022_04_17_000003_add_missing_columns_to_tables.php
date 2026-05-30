<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // class_request: tambah kolom premium dan accepted_by
        Schema::table('class_request', function (Blueprint $table) {
            $table->tinyInteger('premium')->default(0)->after('status');
            $table->unsignedBigInteger('accepted_by')->nullable()->after('premium');
        });

        // user_data: tambah kolom signature_url dan education
        Schema::table('user_data', function (Blueprint $table) {
            if (!Schema::hasColumn('user_data', 'education')) {
                $table->text('education')->nullable()->after('bio');
            }
            $table->string('signature_url')->nullable()->after('education');
        });

        // payment_models: tambah kolom owner_name
        Schema::table('payment_models', function (Blueprint $table) {
            $table->string('owner_name')->nullable()->after('no_rekening');
        });

        // orders: tambah kolom user_id
        Schema::table('orders', function (Blueprint $table) {
            if (!Schema::hasColumn('orders', 'user_id')) {
                $table->unsignedBigInteger('user_id')->nullable()->after('id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('class_request', function (Blueprint $table) {
            $table->dropColumn(['premium', 'accepted_by']);
        });
        Schema::table('user_data', function (Blueprint $table) {
            $table->dropColumn(['signature_url']);
        });
        Schema::table('payment_models', function (Blueprint $table) {
            $table->dropColumn(['owner_name']);
        });
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['user_id']);
        });
    }
};
