<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\Order;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function showPackage() 
    {
        $packages = Package::get();
        return view('frontend.pages.package_purchase', compact('packages'));    
    }
}
