<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\CoursePurchaes;
use PDF;
use View;
use Illuminate\Http\Request;

class BillReportController extends Controller
{
    public function AdminBillReport() 
    {
        $bills = CoursePurchaes::paginate(5);
        
        return view('admin.bill-report.index', compact('bills'));
    }

    public function ReportBillPDF() 
    {
        $bills = CoursePurchaes::get();
        
        $pdf = PDF::loadView('admin.bill-report.bill-pdf', compact('bills'));
        return $pdf->stream('bill-pdf.pdf');    
    }
}
