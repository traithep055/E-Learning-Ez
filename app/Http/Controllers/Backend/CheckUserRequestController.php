<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Become_teacher;
use App\Models\User;
use DB;

class CheckUserRequestController extends Controller
{
    public function index() 
    {
        $becomeTeachers = Become_teacher::where('status', 'pending')->paginate(10);
        
        return view('admin.manageuser.request_to_teacher', compact('becomeTeachers'));    
    }

    public function download($id)
    {
        $becomeTeachersPDF = Become_teacher::findOrFail($id);
        if ($becomeTeachersPDF->pdf_path) {
            $pdfPath = public_path(trim($becomeTeachersPDF->pdf_path, '/')); // ลบช่องว่างหน้าและหลังพาธ
            if (file_exists($pdfPath)) {
                return response()->download($pdfPath);
            }
        }

        toastr()->error('No file found for this application.');
        return redirect()->back();
    }

    public function approve(Request $request, $id)  
    {
        // ดึงข้อมูลคำขอเป็นครู (teacher request)
        $teacherRequest = Become_teacher::findOrFail($id);
        
        // ดึงข้อมูลผู้ใช้
        $user = User::findOrFail($teacherRequest->user_id);
        
        // เปลี่ยน role เป็น "teacher" สำหรับผู้ใช้
        $user->role = 'teacher';
        $user->save();
        
        // เปลี่ยนสถานะเป็น "approve" สำหรับคำขอเป็นครู
        $teacherRequest->status = 'approve';
        $teacherRequest->save();
        
        toastr()->success('Teacher request has been approved successfully.');
        return redirect()->back();
    }

    public function decline(Request $request, $id)  
    {
        // ดึงข้อมูลคำขอเป็นครู (teacher request)
        $teacherRequest = Become_teacher::findOrFail($id);
        
        // เปลี่ยนสถานะเป็น "decline" สำหรับคำขอเป็นครู
        $teacherRequest->status = 'decline';
        $teacherRequest->save();
        
        toastr()->success('Teacher request has been decline successfully.');
        return redirect()->back();
    }

}
