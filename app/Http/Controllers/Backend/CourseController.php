<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\DataTables\CourseDataTable;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CourseDataTable $dataTable)
    {
        return $dataTable->render('teacher.course.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('teacher.course.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => ['required', 'image', 'max:3000'],
            'name' => ['required', 'max:200'],
            'category' => ['required'],
            'level' => ['required'],
            'price' => ['required', 'numeric'],
            'content' => ['required'],
            'status' => ['required'],
            'hours' => ['required', 'numeric']
        ]);


        $course = new Course();
        if ($request->hasFile('image')) {
            if (File::exists(public_path($course->image))) {
                File::delete(public_path($course->image));
            }

            $image = $request->image;
            $imageName = rand().'_'.$image->getClientOriginalName();
            $image->move(public_path('course_img'), $imageName);

            $path = "/course_img/".$imageName;

            $course->image = $path;
        }
        $course->name = $request->name;
        $course->slug = Str::slug($request->name);
        $course->teacher_id = Auth::user()->teacher->id;
        $course->category_id = $request->category;
        $course->sub_category_id = $request->sub_category;
        $course->level = $request->level;
        $course->content = $request->content;
        $course->price = $request->price;
        $course->course_type = 'new_arrival';
        $course->status = $request->status;
        $course->hours = $request->hours;
        $course->save();

        toastr()->success('Created Course Successfully');

        return redirect()->route('teacher.courses.index');
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
    public function edit(string $id)
    {
        $course = Course::findOrfail($id);
        $subCategories = SubCategory::where('category_id', $course->category_id)->get();
        $categories = Category::all();
        return view('teacher.course.edit', compact('course', 'categories', 'subCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'image' => ['nullable', 'image', 'max:3000'],
            'name' => ['required', 'max:200'],
            'category' => ['required'],
            'level' => ['required'],
            'price' => ['required', 'numeric'],
            'content' => ['required'],
            'status' => ['required'],
            'hours' => ['required', 'numeric']
        ]);


        $course = Course::findOrFail($id);
        if ($request->hasFile('image')) {
            if (File::exists(public_path($course->image))) {
                File::delete(public_path($course->image));
            }

            $image = $request->image;
            $imageName = rand().'_'.$image->getClientOriginalName();
            $image->move(public_path('course_img'), $imageName);

            $path = "/course_img/".$imageName;

            $course->image = $path;
        }
        $course->name = $request->name;
        $course->slug = Str::slug($request->name);
        $course->teacher_id = Auth::user()->teacher->id;
        $course->category_id = $request->category;
        $course->sub_category_id = $request->sub_category;
        $course->level = $request->level;
        $course->content = $request->content;
        $course->price = $request->price;
        $course->course_type = 'new_arrival';
        $course->status = $request->status;
        $course->hours = $request->hours;
        $course->save();

        toastr()->success('Update Course Successfully');

        return redirect()->route('teacher.courses.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    // 
    public function destroy(string $id)
    {
        $course = Course::findOrFail($id); 
    
        // ลบไฟล์รูปภาพของคอร์ส
        if ($course->image && File::exists(public_path($course->image))) {
            File::delete(public_path($course->image));
        }
    
        // หาบทเรียนที่เกี่ยวข้องกับคอร์สและลบไฟล์เอกสารและวิดีโอที่เกี่ยวข้อง
        $lessons = Lesson::where('course_id', $id)->get();
        foreach ($lessons as $lesson) {
            if ($lesson->file_doc && File::exists(public_path($lesson->file_doc))) {
                File::delete(public_path($lesson->file_doc));
            }
            if ($lesson->video_path && File::exists(public_path($lesson->video_path))) {
                File::delete(public_path($lesson->video_path));
            }
            $lesson->delete();
        }
    
        // ลบข้อมูลคอร์สในฐานข้อมูล
        $course->delete();
    
        return response(['status' => 'success', 'Deleted Successfully!']);
    }

    /**
     * Get all course sub category.
     */
    public function getSubCategories(Request $request) 
    {
        $subCategoeris = SubCategory::where('category_id',$request->id)->get();   
        return $subCategoeris;  
    }

    public function changeStatus(Request $request) 
    {
        $course = Course::findOrFail($request->id);
        $course->status = $request->status == 'true' ? 1 : 0;
        $course->save();

        return response(['message' => 'Status has been updated']);
    }
}
