<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\TeacherController;
use App\Http\Controllers\Frontend\UserDashboardContorller;
use App\Http\Controllers\Frontend\UserProfileController;
use App\Http\Controllers\Frontend\NewBecomeTeacherController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\FrontendCourseController;
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

Route::group(['middleware' => ['auth', 'verified'], 'prefix' => 'user', 'as' => 'user.'], function () {
    Route::get('dashboard', [UserDashboardContorller::class, 'index'])->name('dashboard');
    Route::get('profile', [UserProfileController::class, 'index'])->name('profile'); //user.profile
    Route::put('profile', [UserProfileController::class, 'updateProfile'])->name('profile.update'); //user.profile.update
    Route::post('profile', [UserProfileController::class, 'updatePassword'])->name('profile.update.password'); //user.profile.update.password

    // ส่งคำขอจาก user เป็น teacher
    Route::get('become-teacher', [NewBecomeTeacherController::class, 'index'])->name('become_teacher');
    Route::post('become-teacher', [NewBecomeTeacherController::class, 'store'])->name('become_teacher.store');

});