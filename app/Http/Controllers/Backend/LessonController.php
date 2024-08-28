<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\DataTables\LessonDataTable;
use App\Models\Course;
use App\Models\Lesson;
use Str;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, LessonDataTable $dataTable)
    {
        $course = Course::findOrfail($request->course);
        return $dataTable->render('teacher.lesson.index', compact('course'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $course = Course::findOrFail($request->course);
        return view('teacher.lesson.create', compact('course'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $course = Course::findOrFail($request->course);

        $request->validate([
            'lesson_name' => ['required', 'max:200'],
            'description' => ['required'],
            'file_doc' => ['nullable', 'mimes:pdf', 'max:20480'],
            'video_url' => ['nullable', 'url'],
            'video_path' => ['nullable', 'file', 'mimes:mp4,mov,avi', 'max:20480'] // 20MB maximum size for video file
        ]);

        $lesson = new Lesson();
        
        if ($request->hasFile('file_doc')) {
            // ลบไฟล์ PDF เก่า (ถ้ามี)
            if ($lesson->file_doc && File::exists(public_path($lesson->file_doc))) {
                File::delete(public_path($lesson->file_doc));
            }

            // อัปโหลดไฟล์ PDF ใหม่
            $file_doc = $request->file('file_doc');
            $file_docName = uniqid() . '_' . $file_doc->getClientOriginalName();
            $file_doc->move(public_path('lesson_files'), $file_docName);

            // เก็บที่อยู่ของไฟล์ PDF ในฐานข้อมูล
            $path = "/lesson_files/" . $file_docName;
            $lesson->file_doc = $path;
        }

        // เก็บ Videos
        if ($request->hasFile('video_path')) {
            // ลบไฟล์ Video เก่า (ถ้ามี)
            if ($lesson->video_path && File::exists(public_path($lesson->video_path))) {
                File::delete(public_path($lesson->video_path));
            }

            // อัปโหลดไฟล์ Video ใหม่
            $video_path = $request->file('video_path');
            $video_pathName = uniqid() . '_' . $video_path->getClientOriginalName();
            $video_path->move(public_path('lesson_videos'), $video_pathName);

            // เก็บที่อยู่ของไฟล์ Video ในฐานข้อมูล
            $path = "/lesson_videos/" . $video_pathName;
            $lesson->video_path = $path;
        }

        // สร้าง slug โดยใช้ Str::slug()
        $lessonSlug = $request->lesson_name;
        $lessonSlug = preg_replace('/[^a-zA-Z0-9ก-ฮะ-์ ]/', '', $lessonSlug);
        $lessonSlug = str_replace(' ', '-', $lessonSlug);
        $lessonSlug = strtolower($lessonSlug);

        $lesson->course_id = $request->course;
        $lesson->lesson_name = $request->lesson_name;
        $lesson->slug = $lessonSlug;
        $lesson->description = $request->description;
        $lesson->video_url = $request->video_url;
        $lesson->save();

        toastr()->success('Created Lesson Successfully');

        return redirect()->route('teacher.lesson.index', ['course' => $course->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $id)
    {
        $course = Course::findOrFail($request->course);
        $lesson = Lesson::findOrfail($id);
        return view('teacher.lesson.edit', compact('lesson', 'course'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $course = Course::findOrFail($request->course);

        $request->validate([
            'lesson_name' => ['required', 'max:200'],
            'description' => ['required'],
            'file_doc' => ['nullable', 'mimes:pdf', 'max:20480'],
            'video_url' => ['nullable', 'url'],
            'video_path' => ['nullable', 'file', 'mimes:mp4,mov,avi', 'max:20480'] // 20MB maximum size for video file
        ]);

        $lesson = Lesson::findOrFail($id);
        
        if ($request->hasFile('file_doc')) {
            // ลบไฟล์ PDF เก่า (ถ้ามี)
            if ($lesson->file_doc && File::exists(public_path($lesson->file_doc))) {
                File::delete(public_path($lesson->file_doc));
            }

            // อัปโหลดไฟล์ PDF ใหม่
            $file_doc = $request->file('file_doc');
            $file_docName = uniqid() . '_' . $file_doc->getClientOriginalName();
            $file_doc->move(public_path('lesson_files'), $file_docName);

            // เก็บที่อยู่ของไฟล์ PDF ในฐานข้อมูล
            $path = "/lesson_files/" . $file_docName;
            $lesson->file_doc = $path;
        }

        // เก็บ Videos
        if ($request->hasFile('video_path')) {
            // ลบไฟล์ Video เก่า (ถ้ามี)
            if ($lesson->video_path && File::exists(public_path($lesson->video_path))) {
                File::delete(public_path($lesson->video_path));
            }

            // อัปโหลดไฟล์ Video ใหม่
            $video_path = $request->file('video_path');
            $video_pathName = uniqid() . '_' . $video_path->getClientOriginalName();
            $video_path->move(public_path('lesson_videos'), $video_pathName);

            // เก็บที่อยู่ของไฟล์ Video ในฐานข้อมูล
            $path = "/lesson_videos/" . $video_pathName;
            $lesson->video_path = $path;
        }

        // สร้าง slug โดยใช้ Str::slug()
        $lessonSlug = $request->lesson_name;
        $lessonSlug = preg_replace('/[^a-zA-Z0-9ก-ฮะ-์ ]/', '', $lessonSlug);
        $lessonSlug = str_replace(' ', '-', $lessonSlug);
        $lessonSlug = strtolower($lessonSlug);

        $lesson->lesson_name = $request->lesson_name;
        $lesson->slug = $lessonSlug;
        $lesson->description = $request->description;
        $lesson->video_url = $request->video_url;
        $lesson->save();

        toastr()->success('Updated Lesson Successfully');

        return redirect()->route('teacher.lesson.index', ['course' => $course->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $lesson = Lesson::findOrFail($id); 

        // ลบไฟล์เอกสาร (PDF) ของ lesson ออก
        if ($lesson->file_doc && File::exists(public_path($lesson->file_doc))) {
            File::delete(public_path($lesson->file_doc));
        }

        // ลบไฟล์วิดีโอของ lesson ออก
        if ($lesson->video_path && File::exists(public_path($lesson->video_path))) {
            File::delete(public_path($lesson->video_path));
        }

        // ลบข้อมูล lesson ในฐานข้อมูล
        $lesson->delete();

        return response(['status' => 'success', 'Deleted Successfully!']);
    }

    public function DelDoc(string $id) 
    {
        $lesson = Lesson::findOrFail($id);

        // Check if file_doc exists and delete it
        if ($lesson->file_doc && File::exists(public_path($lesson->file_doc))) {
            File::delete(public_path($lesson->file_doc));
        }   
        
        // Set file_doc attribute to null
        $lesson->file_doc = null; 
        $lesson->save();
        
        // Return success response
        return response()->json(['status' => 'success', 'message' => 'File deleted successfully']);
    }

    public function DelVideo(string $id) 
    {
        $lesson = Lesson::findOrFail($id);

        // ลบไฟล์วิดีโอของ lesson ออก
        if ($lesson->video_path && File::exists(public_path($lesson->video_path))) {
            File::delete(public_path($lesson->video_path));
        }   
        
        // Set video_path attribute to null
        $lesson->video_path = null; 
        $lesson->save();
        
        // Return success response
        return response()->json(['status' => 'success', 'message' => 'File deleted successfully']);
    }
}
