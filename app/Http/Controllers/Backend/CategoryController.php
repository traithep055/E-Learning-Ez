<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::paginate(5);
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:200', 'unique:categories,name'],
            'status' => ['required']
        ]);

        // แปลงชื่อหมวดหมู่เป็น UTF-8
        $utf8Name = mb_convert_encoding($request->name, 'UTF-8');

        // กรองหรือลบตัวอักษรพิเศษหรืออักขระพิเศษที่ไม่ถูกต้อง
        $filteredName = preg_replace('/[^\p{L}\p{N}\s]/u', '', $utf8Name);

        // สร้าง slug
        $slug = Str::slug($filteredName);

        $category = new Category();

        $category->name = $request->name;
        $category->slug = $filteredName;
        $category->status = $request->status;
        $category->save();

        toastr('Create Successfully!', 'success');

        return redirect()->route('admin.category.index');
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
        $category = Category::findOrFail($id);
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'max:200', 'unique:categories,name,'.$id],
            'status' => ['required']
        ]);

        // แปลงชื่อหมวดหมู่เป็น UTF-8
        $utf8Name = mb_convert_encoding($request->name, 'UTF-8');

        // กรองหรือลบตัวอักษรพิเศษหรืออักขระพิเศษที่ไม่ถูกต้อง
        $filteredName = preg_replace('/[^\p{L}\p{N}\s]/u', '', $utf8Name);

        // สร้าง slug
        $slug = Str::slug($filteredName);

        $category = Category::findOrFail($id);

        $category->name = $request->name;
        $category->slug = $filteredName;
        $category->status = $request->status;
        $category->save();

        toastr('Update Successfully!', 'success');

        return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id); 
        $category->delete();

        return response(['status' => 'success', 'Deleted Successfully!']);
    }

    public function changeStatus(Request $request) 
    {
        $category = Category::findOrFail($request->id);
        $category->status = $request->status == 'true' ? 1 : 0;
        $category->save();

        return response(['message' => 'Status has been updated']);
    }

}
