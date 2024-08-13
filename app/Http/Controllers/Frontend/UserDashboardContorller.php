<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class UserDashboardContorller extends Controller
{
    public function index() 
    {
        $userId = auth()->user()->id;
        $userCoupons = Coupon::with('package')->where('user_id', $userId)->get(); // คูปองของผู้ใช้ที่ล็อกอิน
        $generalCoupons = Coupon::with('package')->whereNull('user_id')->get(); // คูปองที่ user_id เป็น null
        return view('frontend.dashboard.dashboard', compact('userCoupons', 'generalCoupons'));      
    }
}
