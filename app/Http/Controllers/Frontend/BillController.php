<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\CoursePurchaes;
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
}
