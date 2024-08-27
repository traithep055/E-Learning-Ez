<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\DataTables\AllCourseDataTable;
use App\Models\Course;
use PDF;
use View;
use Illuminate\Http\Request;

class AllCourseController extends Controller
{
    public function index() 
    {
        $courses = Course::paginate(10);
        return view('admin.course-report.index', compact('courses'));
    }
    
    public function ReportCoursePDF() 
    {
        $courses = Course::get();

        $pdf = PDF::loadView('admin.course-report.course-pdf', compact('courses'));
        return $pdf->stream('course-pdf.pdf');
    }
}
