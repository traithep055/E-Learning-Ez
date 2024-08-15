<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    // เพิ่ม course_id ไปใน fillable
    protected $fillable = [
        'course_id',
        'user_id',
        'rating',
        'comment',
    ];

    // ความสัมพันธ์กับผู้ใช้
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // ความสัมพันธ์กับคอร์ส
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
