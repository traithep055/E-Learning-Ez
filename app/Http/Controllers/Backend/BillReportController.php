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

        // Check for filtering by month range and year
        if ($request->filled('start_month') || $request->filled('end_month') || $request->filled('year')) {
            if ($request->filled('start_month') && $request->filled('end_month')) {
                $query->whereMonth('created_at', '>=', $request->start_month)
                    ->whereMonth('created_at', '<=', $request->end_month);
            }
            
            if ($request->filled('year')) {
                $query->whereYear('created_at', $request->year);
            }
        }

        $bills = $query->paginate(5);

        // Define Thai month names
        $thaiMonths = [
            1 => 'มกราคม',
            2 => 'กุมภาพันธ์',
            3 => 'มีนาคม',
            4 => 'เมษายน',
            5 => 'พฤษภาคม',
            6 => 'มิถุนายน',
            7 => 'กรกฎาคม',
            8 => 'สิงหาคม',
            9 => 'กันยายน',
            10 => 'ตุลาคม',
            11 => 'พฤศจิกายน',
            12 => 'ธันวาคม',
        ];

        return view('admin.bill-report.index', compact('bills', 'thaiMonths'));
    }

    public function ReportBillPDF(Request $request) 
    {
        $query = CoursePurchaes::query();

        // Check for filtering by month range and year
        if ($request->filled('start_month') || $request->filled('end_month') || $request->filled('year')) {
            if ($request->filled('start_month') && $request->filled('end_month')) {
                $query->whereMonth('created_at', '>=', $request->start_month)
                    ->whereMonth('created_at', '<=', $request->end_month);
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
