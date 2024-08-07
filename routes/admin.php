<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\CheckUserRequestController;
use App\Http\Controllers\Backend\AllUserController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\AllCourseController;
use App\Http\Controllers\Backend\BillReportController;
use App\Http\Controllers\Backend\CeReportController;
use Illuminate\Support\Facades\Route;

/*** Admin Route ***/
Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

/** Admin Profile Route */
Route::get('profile', [ProfileController::class, 'index'])->name('profile');
Route::post('profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update'); //Update Profile || name = admin.profile.update
Route::post('profile/update/password', [ProfileController::class, 'updatePassword'])->name('password.update'); //Update Password
/** End Admin Profile Route */

/** Manage User Route */
// Request to be a Teacher
Route::get('manage-user', [CheckUserRequestController::class, 'index'])->name('managebecome_teacher'); //show หน้าแสดงคำขอ
Route::get('manage-user/download/{id}', [CheckUserRequestController::class, 'download'])->name('managebecome_teacher.download'); // download รายละเอียดคำขอ
Route::post('manage-user/approve/{user_id}', [CheckUserRequestController::class, 'approve'])->name('managebecome_teacher.approve');
Route::post('manage-user/decline/{user_id}', [CheckUserRequestController::class, 'decline'])->name('managebecome_teacher.decline');
// Show All Users
Route::get('all-user', [AllUserController::class, 'allUser'])->name('all_users');
/** End Manage User Route */

/** Category Route */
Route::put('change-status', [CategoryController::class, 'changeStatus'])->name('category.change-status');
Route::resource('category', CategoryController::class);
/** Sub Category Route */
Route::put('subcategory/change-status', [SubCategoryController::class, 'changeStatus'])->name('sub-category.change-status');
Route::resource('sub-category', SubCategoryController::class);

/** Coupon Route */
Route::resource('coupons', CouponController::class);

/** All Course Report */
Route::get('all-course', [AllCourseController::class, 'index'])->name('all-course');

/** Bill Report */
Route::get('bill-report', [BillReportController::class, 'AdminBillReport'])->name('bill-report');

/** Certificate Report */
Route::get('cert-report', [CeReportController::class, 'CertReportAdmin'])->name('cert-report');
