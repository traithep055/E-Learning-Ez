<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Teacher;
use App\Models\User;
use App\Models\Course;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard() 
    {
        $adminCount = Admin::count(); // Get the count of admins
        $teacherCount = Teacher::count(); // Get the count of teachers
        $studentCount = User::where('role', 'user')->count(); // Get the count of students with role 'user'
        $courseCount = Course::count(); // Get the count of courses

        // Fetch user counts for each role
        $rolesCount = User::select('role', \DB::raw('count(*) as count'))
                          ->groupBy('role')
                          ->pluck('count', 'role')
                          ->toArray();
        
        // Fetch course counts by category
        $categories = Category::withCount('courses')->get();

        $totalCourses = Course::count();

        return view('admin.dashboard', [
            'adminCount' => $adminCount,
            'teacherCount' => $teacherCount,
            'studentCount' => $studentCount,
            'courseCount' => $courseCount,
        ],
            compact('rolesCount', 'categories', 'totalCourses')
        );    
    }

    public function login() 
    {
        return view('admin.auth.login');
    }
}
