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
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained('courses')->onDelete('cascade');
            $table->string('lesson_name');
            $table->string('slug');
            $table->text('description')->nullable();
            $table->text('file_doc')->nullable();
            $table->text('video_url')->nullable(); // เพิ่มคอลัมน์เก็บ URL ของวิดีโอ
            $table->text('video_path')->nullable(); // เพิ่มคอลัมน์เก็บเส้นทางของไฟล์วิดีโอ
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lessons');
    }
};
