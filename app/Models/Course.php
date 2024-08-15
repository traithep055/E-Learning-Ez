<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    public function teacher() 
    {
        return $this->belongsTo(Teacher::class);    
    }

    public function lessons() 
    {
        return $this->hasMany(Lesson::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }

    public function purchasedCourses()
    {
        return $this->belongsToMany(User::class, 'course_purchaes', 'course_id', 'user_id');
    }

    // ความสัมพันธ์กับแบบทดสอบ
    public function test()
    {
        return $this->hasOne(Test::class);
    }

    // ความสัมพันธ์กับรีวิว
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // ความสัมพันธ์กับสรุปคะแนนรีวิว (ถ้ามี)
    public function reviewSummary()
    {
        return $this->hasOne(CourseReviewSummary::class);
    }
}
