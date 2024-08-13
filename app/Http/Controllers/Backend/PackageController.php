<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $packages = Package::paginate(5);
        return view('admin.package.index', compact('packages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.package.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'duration' => 'required|in:1_year,2_years,3_years',
            'discount' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:0',
        ]);

        $package = new Package();
        $package->name = $request->name;
        $package->description = $request->description;
        $package->duration = $request->duration;
        $package->discount = $request->discount;
        $package->price = $request->price;
        $package->save();

        toastr('สร้างแพ็คเกจเสร็จสิ้น!', 'success');

        return redirect()->route('admin.package.index');
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
        $package = Package::findOrFail($id);
        return view('admin.package.edit', compact('package'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'duration' => 'required|in:1_year,2_years,3_years',
            'discount' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:0',
        ]);

        $package = Package::findOrFail($id);
        $package->name = $request->name;
        $package->description = $request->description;
        $package->duration = $request->duration;
        $package->discount = $request->discount;
        $package->price = $request->price;
        $package->save();

        toastr('แก้ไขแพ็คเกจเสร็จสิ้น!', 'success');

        return redirect()->route('admin.package.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $package = Package::findOrFail($id); 
        $package->delete();

        return response(['status' => 'success', 'Deleted Successfully!']);
    }
}
