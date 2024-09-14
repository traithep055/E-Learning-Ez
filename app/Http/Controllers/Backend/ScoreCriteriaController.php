<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ScoreCriteria;
use Illuminate\Http\Request;

class ScoreCriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $criterias = ScoreCriteria::paginate(5);
        return view('admin.score-criteria.index', compact('criterias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.score-criteria.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'criteria' => ['required', 'numeric', 'min:0']
        ]);

        $criteria = new ScoreCriteria();

        $criteria->criteria = $request->criteria;
        $criteria->save();

        toastr('กำหนกเกณฑ์เสร็จสิ้น', 'success');

        return redirect()->route('admin.scorecriteria.index');
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
        $criteria = ScoreCriteria::findOrFail($id);
        return view('admin.score-criteria.edit', compact('criteria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'criteria' => ['required', 'numeric', 'min:0']
        ]);

        $criteria = ScoreCriteria::findOrFail($id);

        $criteria->criteria = $request->criteria;
        $criteria->save();

        toastr('แก้ไขเกณฑ์เสร็จสิ้น', 'success');

        return redirect()->route('admin.scorecriteria.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
