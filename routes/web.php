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

    /** หน้าซื้อคอร์ส */
    Route::get('course-purchase', [CoursePurchaseController::class, 'create'])->name('course_purchase');
    Route::post('course_purchases', [CoursePurchaseController::class, 'store'])->name('course_purchase.store');

    /** หน้าใบเสร็จ */
    Route::get('course-bill/{id}', [BillController::class, 'BillCourse'])->name('course-bill');
    Route::get('course-download-pdf{id}', [BillController::class, 'downloadPDFbill'])->name('course_bill.downloadPDF');

    /** หน้าการเรียน */
    Route::get('learn-course', [LearnController::class, 'index'])->name('learn_course');

});

Route::group(['middleware' => 'auth'], function () {
    Route::resource('admin/coupons', CouponController::class)->except(['show']);
});

Route::get('/api/coupons/{code}', function ($code) {
    $coupon = Coupon::where('code', $code)->first();

    if (!$coupon) {
        return response()->json(['error' => 'Coupon not found'], 404);
    }

    // ตรวจสอบว่าคูปองยังใช้งานได้อยู่หรือไม่ หากหมดอายุแล้วจะไม่สามารถใช้ได้
    if ($coupon->expires_at && now()->greaterThanOrEqualTo($coupon->expires_at)) {
        return response()->json(['error' => 'Coupon has expired'], 400);
    }

    // ส่งข้อมูลคูปองกลับไปให้กับผู้ใช้
    return response()->json(['discounted_price' => $coupon->discount, 'discount_percentage' => $coupon->discount_percentage]);
});
