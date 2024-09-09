<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AddAdminController extends Controller
{
    public function index() 
    {
        return view('admin.manageuser.add-admin');    
    }

    public function addAdmin(Request $request) 
    {
        // ตรวจสอบความถูกต้องของฟิลด์ที่ป้อน
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:15'],
        ]);

        // สร้างผู้ใช้ใหม่ในตาราง 'users' พร้อมกับกำหนดบทบาทเป็น 'admin'
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'admin',  // กำหนดบทบาทเป็น 'admin'
            'password' => Hash::make($request->password), // แฮชรหัสผ่าน
        ]);

        // ตรวจสอบว่าการสร้างผู้ใช้สำเร็จก่อนที่จะสร้างผู้ดูแล
        if ($user) {
            // สร้างผู้ดูแลใหม่ในตาราง 'admins'
            Admin::create([
                'user_id' => $user->id,  // ใช้ ID ของผู้ใช้ที่เพิ่งถูกสร้าง
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'phone' => $request->phone,
                // 'image' => $request->image, // ถ้าต้องการอัปโหลดภาพในภายหลัง
            ]);

            toastr()->success('ผู้ดูแลระบบถูกเพิ่มเรียบร้อยแล้ว');
            return redirect()->route('admin.add-admin.index');
        }

        return redirect()->back()->withErrors(['error' => 'ไม่สามารถเพิ่มผู้ดูแลระบบได้']);
    }
}
