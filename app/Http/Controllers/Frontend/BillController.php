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
    public function BillCourse($id) 
    {
        $coursepurchae = CoursePurchaes::findOrFail($id);

        return view('frontend.pages.course_bill', compact('coursepurchae'));
    }

    public function downloadPDFbill($id) 
    {
        $purchase = CoursePurchaes::findOrFail($id);
        
        // Render the Blade view to a string
        $html = View::make('frontend.pdf.course_bill_report', compact('purchase'))->render();

        $pdf = PDF::loadHTML($html);
        // Stream the generated PDF back to the user
        return $pdf->stream('course_bill_report.pdf');    
    }
}
