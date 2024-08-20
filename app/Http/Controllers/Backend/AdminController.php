<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Teacher;
use App\Models\User;
use App\Models\Course;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard() 
    {
        $adminCount = Admin::count(); // Get the count of admins
        $teacherCount = Teacher::count(); // Get the count of teachers
        $studentCount = User::where('role', 'user')->count(); // Get the count of students with role 'user'
        $courseCount = Course::count(); // Get the count of courses

        return view('admin.dashboard', [
            'adminCount' => $adminCount,
            'teacherCount' => $teacherCount,
            'studentCount' => $studentCount,
            'courseCount' => $courseCount,
        ]);    
    }

    public function login() 
    {
        return view('admin.auth.login');
    }
}
