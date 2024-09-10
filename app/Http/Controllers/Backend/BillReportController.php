<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\CoursePurchaes;
use PDF;
use View;
use Illuminate\Http\Request;

class BillReportController extends Controller
{
    public function AdminBillReport(Request $request) 
    {
        $query = CoursePurchaes::query();

        // ตรวจสอบว่ามีการกรองตามวัน เดือน หรือปี
        if ($request->filled('day') || $request->filled('month') || $request->filled('year')) {
            if ($request->filled('day')) {
                $query->whereDay('created_at', $request->day);
            }
            
            if ($request->filled('month')) {
                $query->whereMonth('created_at', $request->month);
            }
            
            if ($request->filled('year')) {
                $query->whereYear('created_at', $request->year);
            }
        }

        $bills = $query->paginate(5);
        
        return view('admin.bill-report.index', compact('bills'));
    }

    public function ReportBillPDF(Request $request) 
    {
        $query = CoursePurchaes::query();

        // ตรวจสอบว่ามีการกรองตามวัน เดือน หรือปี
        if ($request->filled('day') || $request->filled('month') || $request->filled('year')) {
            if ($request->filled('day')) {
                $query->whereDay('created_at', $request->day);
            }
            
            if ($request->filled('month')) {
                $query->whereMonth('created_at', $request->month);
            }
            
            if ($request->filled('year')) {
                $query->whereYear('created_at', $request->year);
            }
        }

        $bills = $query->get();
        $pdf = PDF::loadView('admin.bill-report.bill-pdf', compact('bills'));

        return $pdf->stream('bill-pdf.pdf');
    }
}
