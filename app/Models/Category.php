<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function SubCategory() 
    {
        return $this->hasMany(SubCategory::class);    
    }

    // การกำหนดความสัมพันธ์กับคอร์ส
    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
