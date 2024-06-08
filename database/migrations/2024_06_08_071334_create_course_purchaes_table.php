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
        Schema::create('course_purchaes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('course_id')->constrained('courses')->onDelete('cascade');
            $table->double('price'); // Original price of the course
            $table->double('final_price'); // Final price after applying coupon
            $table->text('slip_image')->nullable(); // Path to uploaded slip image
            $table->foreignId('coupon_id')->nullable()->constrained('coupons')->onDelete('set null'); // Nullable coupon ID
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_purchaes');
    }
};
