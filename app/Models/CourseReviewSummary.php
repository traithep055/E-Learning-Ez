<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseReviewSummary extends Model
{
    use HasFactory;

    // เพิ่ม course_id ไปใน fillable
    protected $fillable = [
        'course_id',
        'total_reviews',
        'average_rating',
    ];

    // ความสัมพันธ์กับคอร์ส
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
