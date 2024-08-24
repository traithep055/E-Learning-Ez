<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\TestResult;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use PDF;
use View;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    public function getCertificate($course_id)
    {
        $user = Auth::user();
        $testResult = TestResult::where('user_id', $user->id)
                                ->whereHas('test.course', function($query) use ($course_id) {
                                    $query->where('id', $course_id);
                                })
                                ->where('score', '>=', 80)
                                ->firstOrFail();

        $course = Course::findOrFail($course_id);

        // สร้างใบประกาศณียบัตร (สมมติว่าคุณใช้แพคเกจ PDF)
        $html = View::make('frontend.certificates.certificate', compact('user', 'course', 'testResult'));

        $pdf = PDF::loadHTML($html);

        return $pdf->stream('certificate.pdf');
    }

    public function getAdminCertificate($course_id, $user_id)
    {
        $testResult = TestResult::where('user_id', $user_id)
                                ->whereHas('test.course', function($query) use ($course_id) {
                                    $query->where('id', $course_id);
                                })
                                ->where('score', '>=', 80)
                                ->firstOrFail();

        $course = Course::findOrFail($course_id);
        $user = $testResult->user; // Retrieve the user associated with the test result

        // Generate the certificate (assuming you use a PDF package)
        $html = View::make('frontend.certificates.certificate', compact('user', 'course', 'testResult'));

        $pdf = PDF::loadHTML($html);

        return $pdf->stream('certificate.pdf');
    }
}
