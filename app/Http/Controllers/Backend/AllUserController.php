<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\Teacher;

class AllUserController extends Controller
{
    public function allUser() 
    {
        $admins = Admin::paginate(5);
        $teachers = Teacher::paginate(5);
        $users = Auth::user()->where('role', 'user')->paginate(5);
        
        return view('admin.manageuser.all_users', compact('admins', 'teachers', 'users'));
    }
}
