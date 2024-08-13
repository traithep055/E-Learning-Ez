<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('coupons', function (Blueprint $table) {
            $table->foreignId('package_id')->nullable()->constrained()->onDelete('cascade'); // เพิ่มคอลัมน์ package_id
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade'); // เพิ่มคอลัมน์ user_id
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('coupons', function (Blueprint $table) {
            $table->dropForeign(['package_id']); // ลบ foreign key ของ package_id
            $table->dropColumn('package_id'); // ลบคอลัมน์ package_id
    
            $table->dropForeign(['user_id']); // ลบ foreign key ของ user_id
            $table->dropColumn('user_id'); // ลบคอลัมน์ user_id
        });
    }
};
