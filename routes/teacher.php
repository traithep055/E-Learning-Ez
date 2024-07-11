<?php

use App\Http\Controllers\Backend\TeacherController;
use App\Http\Controllers\Backend\TeacherProfileController;
use App\Http\Controllers\Backend\CourseController;
use App\Http\Controllers\Backend\LessonController;
use App\Http\Controllers\Backend\TestController;
use Illuminate\Support\Facades\Route;

/***** Teacher Route *****/

/** Dashboard Route */
Route::get('dashboard', [TeacherController::class, 'dashboard'])->name('dashboard'); // route teacher/dashboard || name = teacher.dashboard

/** Profile Route */
Route::get('profile', [TeacherProfileController::class, 'index'])->name('profile'); // route teacher/profile || name = teacher.profile
Route::put('profile', [TeacherProfileController::class, 'updateProfile'])->name('profile.update'); // teacher.profile.update
Route::post('profile', [TeacherProfileController::class, 'updatePassword'])->name('profile.update.password'); // teacher.profile.update.password

/** Course Route */
Route::get('course/get-subcategories', [CourseController::class, 'getSubCategories'])->name('course.get-subcategories');
Route::put('course/change-status', [CourseController::class, 'changeStatus'])->name('course.change-status');
Route::resource('courses', CourseController::class);

/** Lesson Route */
Route::put('lesson/deldoc/{id}', [LessonController::class, 'DelDoc'])->name('lesson.del-doc');
Route::put('lesson/delvideo/{id}', [LessonController::class, 'DelVideo'])->name('lesson.del-video');
Route::get('lesson/create', [LessonController::class, 'create'])->name('lesson.create');
Route::resource('lesson', LessonController::class);

/** Test Route */
Route::resource('tests', TestController::class);