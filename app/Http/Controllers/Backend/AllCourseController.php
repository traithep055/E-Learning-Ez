<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\DataTables\AllCourseDataTable;
use App\Models\Course;
use Illuminate\Http\Request;

class AllCourseController extends Controller
{
    public function index() 
    {
        $courses = Course::paginate(10);
        return view('admin.course-report.index', compact('courses'));
    }
}
