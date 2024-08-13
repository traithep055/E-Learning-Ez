<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\Order;
use App\Models\Subscription;
use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function showPackage() 
    {
        $packages = Package::get();
        return view('frontend.pages.package', compact('packages'));    
    }

    public function packagePurchase(Request $request) 
    {
        $package = Package::findOrFail($request->package);
        return view('frontend.pages.package_purchase', compact('package'));
    }

    public function buyPackage(Request $request) 
    {
        //Validate the request
        $request->validate([
            'payment_slip' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ]);

        // Find the package
        $package = Package::findOrFail($request->package);
        $price = $package->price;

        $order = new Order();

        if ($request->hasFile('payment_slip')) {
            // Upload slip image
            $payment_slip = $request->file('payment_slip');
            $slip_imageName = rand() . '_' . $payment_slip->getClientOriginalName();
            $payment_slip->move(public_path('slip_image'), $slip_imageName);

            // Store slip image path in the database
            $path = "/slip_image/" . $slip_imageName;
            $order->payment_slip = $path;
        } else {
            // If slip image is not provided, return with an error
            toastr()->error('กรุณาแนบสลิปการโอนเงิน');
            return back()->withInput();
        }

        // Generate random order number
        $orderNumber = Str::upper(Str::random(10));

        $order->order_number = $orderNumber;
        $order->user_id = Auth::user()->id;
        $order->package_id = $request->package;
        $order->total = $price;
        $order->status = 'completed'; // This should be set after payment processing
        $order->save();

        // Calculate the end date based on the package duration
        $startDate = Carbon::now();
        switch ($package->duration) {
            case '1_year':
                $endDate = $startDate->copy()->addYear();
                $coupondiscount = $package->discount;
                break;
            case '2_years':
                $endDate = $startDate->copy()->addYears(2);
                $coupondiscount = $package->discount;
                break;
            case '3_years':
                $endDate = $startDate->copy()->addYears(3);
                $coupondiscount = $package->discount;
                break;
            default:
                return response()->json(['error' => 'Invalid package duration'], 400);
        }

        // Create a subscription
        $subscription = new Subscription();
        $subscription->user_id = Auth::user()->id;
        $subscription->package_id = $package->id;
        $subscription->start_date = $startDate;
        $subscription->end_date = $endDate;
        $subscription->save();

        // สร้างคูปองสำหรับผู้ที่ซื้อแพ็คเกจ
        $coupon = new Coupon();
        $coupon->package_id = $package->id;
        $coupon->user_id = Auth::user()->id;
        $coupon->code = $orderNumber;
        $coupon->discount_percentage = $coupondiscount;
        $coupon->expires_at = $endDate;
        $coupon->save();
        
        toastr()->success('สั่งซื้อเสร็จสิ้น');

        return redirect()->route('user.package-bill', ['order_number' => $order->order_number]);
    }

}
