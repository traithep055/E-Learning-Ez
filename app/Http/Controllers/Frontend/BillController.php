<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\CoursePurchaes;
use App\Models\Order;
use PDF;
use View;

class BillController extends Controller
{
    public function BillCourse($order_number)
    {
        $coursepurchae = CoursePurchaes::where('order_number', $order_number)->firstOrFail();

        return view('frontend.pages.course_bill', compact('coursepurchae'));
    }

    public function downloadPDFbill($order_number)
    {
        $purchase = CoursePurchaes::where('order_number', $order_number)->firstOrFail();
        
        // Render the Blade view to a string
        $html = View::make('frontend.pdf.course_bill_report', compact('purchase'))->render();

        $pdf = PDF::loadHTML($html);
        // Stream the generated PDF back to the user
        return $pdf->stream('course_bill_report.pdf');    
    }

    public function BillPackage($order_number)
    {
        $billpackage = Order::where('order_number', $order_number)->firstOrFail();

        return view('frontend.pages.package_bill', compact('billpackage'));
    }

    public function downloadPDFBillPackage($order_number)
    {
        $packagebill = Order::where('order_number', $order_number)->firstOrFail();
        
        // Render the Blade view to a string
        $html = View::make('frontend.pdf.package_bill_report', compact('packagebill'))->render();

        $pdf = PDF::loadHTML($html);
        // Stream the generated PDF back to the user
        return $pdf->stream('package_bill_report.pdf');    
    }
}
