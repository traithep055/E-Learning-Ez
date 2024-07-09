<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\CoursePurchaes;
use App\Models\Coupon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CoursePurchaseController extends Controller
{
    public function create(Request $request)
    {
        $course = Course::findOrFail($request->course);
        return view('frontend.pages.course_purchases', compact('course'));
    }

    public function store(Request $request)
    {
        try {
            $course = Course::findOrFail($request->course);
            $price = $course->price;
            
            $request->validate([
                'slip_image' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
                'coupon_code' => ['nullable', 'string', 'exists:coupons,code'],
            ]);

            $course_purchase = new CoursePurchaes();

            if ($request->hasFile('slip_image')) {
                // Upload slip image
                $slip_image = $request->file('slip_image');
                $slip_imageName = rand() . '_' . $slip_image->getClientOriginalName();
                $slip_image->move(public_path('slip_image'), $slip_imageName);
    
                // Store slip image path in the database
                $path = "/slip_image/" . $slip_imageName;
                $course_purchase->slip_image = $path;
            } else {
                // If slip image is not provided, return with an error
                toastr()->error('กรุณาแนบสลิปการโอนเงิน');
                return back()->withInput();
            }

            // คำนวณราคาหลังจากใช้คูปอง
            $finalPrice = $price;
            $coupon = null;
            if ($request->filled('coupon_code')) {
                $coupon = Coupon::where('code', $request->coupon_code)->first();
                if ($coupon) {
                    if ($coupon->discount) {
                        $finalPrice -= $coupon->discount;
                    } elseif ($coupon->discount_percentage) {
                        $finalPrice -= $price * ($coupon->discount_percentage / 100);
                    }
                }
            }

            // Generate random order number
            $orderNumber = Str::upper(Str::random(10));

            // สร้างรายการการซื้อคอร์ส
            $course_purchase->user_id = Auth::user()->id;
            $course_purchase->course_id = $request->course;
            $course_purchase->price = $price;
            $course_purchase->final_price = $finalPrice;
            $course_purchase->coupon_id = $coupon ? $coupon->id : null;
            $course_purchase->order_number = $orderNumber; // Save the order number
            $course_purchase->save(); // ต้องบันทึกการซื้อ

            toastr()->success('สั่งซื้อเสร็จสิ้น');

            // return redirect()->route('user.learn_course', ['course' => $course->id]);
            return redirect()->route('user.course-bill', ['order_number' => $course_purchase->order_number]);
        } catch (\Exception $e) {
            Log::error('การสั่งซื้อคอร์สล้มเหลว: ' . $e->getMessage());
            toastr()->error('เกิดข้อผิดพลาดในการสั่งซื้อ ไม่ได้อัพโหลดสลิป');
            return back()->withInput();
        }
    }
}
