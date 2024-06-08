<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoursePurchaes extends Model
{
    use HasFactory;

    /**
     * Get the user that purchased the course.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the course that was purchased.
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Get the coupon that was used (if any).
     */
    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }
}
