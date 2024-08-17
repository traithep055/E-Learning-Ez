<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QRCodeController extends Controller
{
    public function generate(Request $request)
    {
        $price = $request->input('price');
        $mobileNumber = '000-000-0000'; // แทนที่ด้วยหมายเลข PromptPay ที่ต้องการ

        // เรียกใช้สคริปต์ Node.js และรับผลลัพธ์
        $payload = shell_exec("node " . base_path('test-promptpay-qr/index.js') . " $mobileNumber $price");
        
        return response($payload, 200)->header('Content-Type', 'image/svg+xml');
    }
}
