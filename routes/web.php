<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\TeacherController;
use App\Http\Controllers\Frontend\UserDashboardContorller;
use App\Http\Controllers\Frontend\UserProfileController;
use App\Http\Controllers\Frontend\NewBecomeTeacherController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\FrontendCourseController;
use App\Http\Controllers\Frontend\FrontendTeacherController;
use App\Http\Controllers\Backend\CoursePurchaseController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Frontend\LearnController;
use App\Http\Controllers\Frontend\BillController;
use App\Http\Controllers\Frontend\MyCourseController;
use App\Http\Controllers\Frontend\ExamController;
use App\Http\Controllers\Frontend\CertificateController;
use App\Http\Controllers\Backend\SubscriptionController;
use App\Http\Controllers\Frontend\ReviewController;
use App\Models\Coupon;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

/*** For Admin ** */
Route::get('admin/login', [AdminController::class, 'login'])->name('admin.login');

/** User Dashboard */
// Route::get('/dashboard', function () {
    
// })->middleware(['auth', 'verified'])->name('dashboard');

/** Course Route */
Route::get('courses', [FrontendCourseController::class, 'coursesIndex'])->name('courses.index');
// ดูรายละเอียดคอร์ส
Route::get('course-detail/{id}', [HomeController::class, 'showcourseDetail'])->name('course-detail');

/** แสดง teacher ที่หน้า home */
Route::get('teachers', [FrontendTeacherController::class, 'index'])->name('teachers.index');
Route::get('teacher-detail/{id}', [FrontendTeacherController::class, 'teacherDetail'])->name('teacher-detail');

Route::group(['middleware' => ['auth', 'verified'], 'prefix' => 'user', 'as' => 'user.'], function () {
    Route::get('dashboard', [UserDashboardContorller::class, 'index'])->name('dashboard');
    Route::get('profile', [UserProfileController::class, 'index'])->name('profile'); //user.profile
    Route::put('profile', [UserProfileController::class, 'updateProfile'])->name('profile.update'); //user.profile.update
    Route::post('profile', [UserProfileController::class, 'updatePassword'])->name('profile.update.password'); //user.profile.update.password

    // ส่งคำขอจาก user เป็น teacher
    Route::get('become-teacher', [NewBecomeTeacherController::class, 'index'])->name('become_teacher');
    Route::post('become-teacher', [NewBecomeTeacherController::class, 'store'])->name('become_teacher.store');

    /** ซื้อแพ็คเกจเสริม */
    Route::get('all-package', [SubscriptionController::class, 'showPackage'])->name('show_package');
    Route::get('package-purchase', [SubscriptionController::class, 'packagePurchase'])->name('package_purchase');
    Route::post('buy-package', [SubscriptionController::class, 'buyPackage'])->name('package_purchase.buy');

    /** หน้าซื้อคอร์ส */
    Route::get('course-purchase', [CoursePurchaseController::class, 'create'])->name('course_purchase');
    Route::post('course_purchases', [CoursePurchaseController::class, 'store'])->name('course_purchase.store');

    /** หน้าใบเสร็จ */
    Route::get('course-bill/{order_number}', [BillController::class, 'BillCourse'])->name('course-bill');
    Route::get('course-download-pdf{order_number}', [BillController::class, 'downloadPDFbill'])->name('course_bill.downloadPDF');
    Route::get('package-bill/{order_number}', [BillController::class, 'BillPackage'])->name('package-bill');
    Route::get('package-download-pdf{order_number}', [BillController::class, 'downloadPDFBillPackage'])->name('package_bill.downloadPDF');

    /** หน้าคอร์สของ User */
    Route::get('mycourse', [MyCourseController::class, 'index'])->name('mycourse');

    /** หน้าการเรียน */
    Route::get('learn-course', [LearnController::class, 'index'])->name('learn_course');
    Route::get('learn-course/{course}/{lesson:slug}', [LearnController::class, 'learn'])->name('learn_course.lesson');

    /** หน้าการทำข้อสอบ */
    Route::get('courses/{course}/test', [ExamController::class, 'take'])->name('tests.take');
    Route::post('tests/{test}/submit', [ExamController::class, 'submit'])->name('tests.submit');
    Route::get('tests/{test}/result', [ExamController::class, 'result'])->name('tests.result');

    /** ใบประกาศนียบัตร */
    Route::get('certificate/download/{course_id}', [CertificateController::class, 'getCertificate'])->name('certificate.download');

    /** หน้ารีวิวคอร์สของ User */
    Route::get('mycourse-review', [ReviewController::class, 'myCoursesReview'])->name('mycourse.review');
    Route::post('courses/{course}/review', [ReviewController::class, 'storeReview'])->name('courses.storeReview');

});

Route::group(['middleware' => 'auth'], function () {
    Route::resource('admin/coupons', CouponController::class)->except(['show']);
});

Route::get('/api/coupons/{code}', function ($code) {
    $coupon = Coupon::where('code', $code)->first();
    
    if (!$coupon) {
        return response()->json(['error' => 'ไม่พบคูปอง'], 404);
    }

    // ตรวจสอบว่าคูปองหมดอายุแล้วหรือไม่
    if ($coupon->expires_at && now()->greaterThanOrEqualTo($coupon->expires_at)) {
        return response()->json(['error' => 'คูปองนี้หมดอายุแล้ว'], 400);
    }

    // ตรวจสอบว่าคูปองนี้ถูกจำกัดการใช้งานเฉพาะผู้ใช้หรือไม่
    if ($coupon->user_id && auth()->id() !== $coupon->user_id) {
        return response()->json(['error' => 'คูปองนี้ไม่สามารถใช้กับบัญชีของคุณได้'], 403);
    }

    // ส่งข้อมูลคูปองกลับไปให้ผู้ใช้หากคูปองยังใช้งานได้
    return response()->json([
        'discounted_price' => $coupon->discount,
        'discount_percentage' => $coupon->discount_percentage
    ]);
});
