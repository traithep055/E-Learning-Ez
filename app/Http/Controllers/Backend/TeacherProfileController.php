<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Teacher;
use File;

class TeacherProfileController extends Controller
{
    public function index() 
    {
        // ดึงข้อมูลของครูที่เกี่ยวข้องกับผู้ใช้ปัจจุบัน
        $teacher = Teacher::where('user_id', Auth::user()->id)->first();

        // ตรวจสอบว่ามีข้อมูลครูหรือไม่
        if (!$teacher) {
            // หากไม่มีข้อมูลครู สร้างข้อมูลครูใหม่
            $teacher = new Teacher();
        }

        return view('teacher.dashboard.profile', compact('teacher'));    
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:100'],
            'email' => ['required', 'email', 'unique:users,email,'.Auth::user()->id],
            'firstname' => ['required', 'max:100'],
            'lastname' => ['required', 'max:100'],
            'image' => ['image', 'max:2048'],
            'phone' => ['required'],
            'education' => ['required'],
        ]);    

        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;

        // ตรวจสอบบทบาทของผู้ใช้ ถ้าเป็น "teacher" ให้อัปเดตข้อมูลเพิ่มเติม
        if ($user->role === 'teacher') {
            $teacher = Teacher::where('user_id', $user->id)->first(); // หาข้อมูล teacher ที่เกี่ยวข้องกับผู้ใช้
            if (!$teacher) {   
                $teacher = new Teacher();
                $teacher->user_id = $user->id;
            }

            if ($request->hasFile('image')) {
                if (File::exists(public_path($teacher->image))) {
                    File::delete(public_path($teacher->image));
                }

                $image = $request->image;
                $imageName = rand().'_'.$image->getClientOriginalName();
                $image->move(public_path('uploads'), $imageName);

                $path = "/uploads/".$imageName;

                $teacher->image = $path;
            }

            $teacher->firstname = $request->firstname;
            $teacher->lastname = $request->lastname;
            $teacher->education = $request->education;
            $teacher->phone = $request->phone;
            $teacher->save();
        }

        $user->save();

        toastr()->success('Profile Updated Successfully!');
        return redirect()->back();
    }

    /** Update Password */
    public function updatePassword(Request $request) 
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $request->user()->update([
            'password' => bcrypt($request->password),
        ]);

        toastr()->success('Password Updated Successfully!');

        return redirect()->back();
    }
}
