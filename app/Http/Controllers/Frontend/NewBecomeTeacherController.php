<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Become_teacher;
use File;

class NewBecomeTeacherController extends Controller
{
    public function index() 
    {
        $user = Auth::user();
        $becomeTeachers = null;

        if ($user) {
            $becomeTeachers = Become_teacher::where('user_id', $user->id)
                ->where('status', 'decline')
                ->first();
        }

        return view('frontend.dashboard.become_teacher', compact('becomeTeachers'));   
    }

    public function store(Request $request) 
    {
        // $request->validate([
        //     'reason' => 'required|string',
        //     'pdf_path' => 'nullable|mimes:pdf|max:2048'
        // ]);    

        // $user = Auth::user();
        // if ($user->role === 'user') {
        //     $becomeTeach = Become_teacher::where('user_id', $user->id)->first(); // หาข้อมูล teacher ที่เกี่ยวข้องกับผู้ใช้
        //     if (!$becomeTeach) {   
        //         $becomeTeach = new Become_teacher();
        //         $becomeTeach->user_id = $user->id;
        //     }

        //     if ($request->hasFile('pdf_path')) {
        //         // ลบไฟล์ PDF เก่า (ถ้ามี)
        //         if ($becomeTeach->pdf_path && File::exists(public_path($becomeTeach->pdf_path))) {
        //             File::delete(public_path($becomeTeach->pdf_path));
        //         }

        //         // อัปโหลดไฟล์ PDF ใหม่
        //         $pdf_path = $request->file('pdf_path');
        //         $pdf_pathName = uniqid() . '_' . $pdf_path->getClientOriginalName();
        //         $pdf_path->move(public_path('become_pdf'), $pdf_pathName);

        //         // เก็บที่อยู่ของไฟล์ PDF ในฐานข้อมูล
        //         $path = "/become_pdf/" . $pdf_pathName;
        //         $becomeTeach->pdf_path = $path;
        //     }

        //     // บันทึกข้อมูลการขอเป็นครู
        //     $becomeTeach->reason = $request->reason;
        //     $becomeTeach->status = 'pending'; // กำหนดสถานะเป็นรอการตรวจสอบ
        //     $becomeTeach->save();
        // }

        // toastr()->success('Your request has been submitted successfully.');
        // return redirect()->back();

        $request->validate([
            'reason' => 'required|string',
            'pdf_path' => 'nullable|mimes:pdf|max:2048'
        ]);    
    
        $user = Auth::user();
        if ($user->role === 'user') {
            $becomeTeach = Become_teacher::where('user_id', $user->id)->first(); // หาข้อมูล teacher ที่เกี่ยวข้องกับผู้ใช้
            if (!$becomeTeach) {   
                $becomeTeach = new Become_teacher();
                $becomeTeach->user_id = $user->id;
            }
    
            if ($request->hasFile('pdf_path')) {
                // ลบไฟล์ PDF เก่า (ถ้ามี)
                if ($becomeTeach->pdf_path && File::exists(public_path($becomeTeach->pdf_path))) {
                    File::delete(public_path($becomeTeach->pdf_path));
                }
    
                // อัปโหลดไฟล์ PDF ใหม่
                $pdf_path = $request->file('pdf_path');
                $pdf_pathName = uniqid() . '_' . $pdf_path->getClientOriginalName();
                $pdf_path->move(public_path('become_pdf'), $pdf_pathName);
    
                // เก็บที่อยู่ของไฟล์ PDF ในฐานข้อมูล
                $path = "/become_pdf/" . $pdf_pathName;
                $becomeTeach->pdf_path = $path;
            }
    
            // บันทึกข้อมูลการขอเป็นครู
            $becomeTeach->reason = $request->reason;
            $becomeTeach->status = 'pending'; // กำหนดสถานะเป็นรอการตรวจสอบ
            $becomeTeach->save();
        }
    
        toastr()->success('Your request has been submitted successfully.');
        return redirect()->back();
    }
}
