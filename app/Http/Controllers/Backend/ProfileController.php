<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use File;

class ProfileController extends Controller
{
    public function index() 
    {
        // ดึงข้อมูลของครูที่เกี่ยวข้องกับผู้ใช้ปัจจุบัน
        $admin = Admin::where('user_id', Auth::user()->id)->first();

        if (!$admin) {
            // หากไม่มีข้อมูล admin  สร้างข้อมูล admin ใหม่
            $admin = new Admin();
        }
        return view('admin.profile.index', compact('admin'));    
    }

    /** Update Profile */
    public function updateProfile(Request $request) 
    {
        $request->validate([
            'name' => ['required', 'max:100'],
            'email' => ['required', 'email', 'unique:users,email,'.Auth::user()->id],
            'firstname' => ['required', 'max:100'],
            'lastname' => ['required', 'max:100'],
            'image' => ['image', 'max:2048'],
            'phone' => ['required'],
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;

        // ตรวจสอบบทบาทของผู้ใช้ ถ้าเป็น "admin" ให้อัปเดตข้อมูลเพิ่มเติม
        if ($user->role === 'admin') {
            $admin = Admin::where('user_id', $user->id)->first(); // หาข้อมูล admin ที่เกี่ยวข้องกับผู้ใช้
            if (!$admin) {   
                $admin = new Admin();
                $admin->user_id = $user->id;
            }

            if ($request->hasFile('image')) {
                if (File::exists(public_path($admin->image))) {
                    File::delete(public_path($admin->image));
                }

                $image = $request->image;
                $imageName = rand().'_'.$image->getClientOriginalName();
                $image->move(public_path('uploads'), $imageName);

                $path = "/uploads/".$imageName;

                $admin->image = $path;
            }

            $admin->firstname = $request->firstname;
            $admin->lastname = $request->lastname;
            $admin->phone = $request->phone;
            $admin->save();
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
