<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\Teacher;
use PDF;
use View;

class AllUserController extends Controller
{
    public function allUser() 
    {
        $admins = Admin::paginate(5);
        $teachers = Teacher::paginate(5);
        $users = Auth::user()->where('role', 'user')->paginate(5);
        
        return view('admin.manageuser.all_users', compact('admins', 'teachers', 'users'));
    }

    public function adminReportPDF() 
    {
        $admins = Admin::get();
        
        $pdf = PDF::loadView('admin.manageuser.admin-report', compact('admins'));
        return $pdf->stream('admin-report.pdf'); 
    }

    public function TeacherReportPDF() 
    {
        $teachers = Teacher::get();
        
        $pdf = PDF::loadView('admin.manageuser.teacher-report', compact('teachers'));
        return $pdf->stream('teacher-report.pdf'); 
    }
    
    public function UserReportPDF() 
    {
        $users = Auth::user()->where('role', 'user')->get();
        $totalCount = $users->count(); // Get the total count of users

        $pdf = PDF::loadView('admin.manageuser.users-report', compact('users', 'totalCount'));
        return $pdf->stream('users-report.pdf'); 
    }
}
