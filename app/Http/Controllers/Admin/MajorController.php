<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MajorRequests\StoreRequest;
use App\Http\Requests\MajorRequests\updateRequest;
use App\Models\AcademicLevel;
use App\Models\Major;
use Illuminate\Http\Request;

class MajorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $majors = Major::with('academicLevel')->latest()->paginate(10);
        return view('admin.majors.index', compact('majors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $academicLevels = AcademicLevel::where('status', true)->get();
        return view('admin.majors.create', compact('academicLevels'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        //
        // $request->validate([
        //     'name_ar' => 'required|string|max:255',
        //     'name_en' => 'required|string|max:255',
        //     'academic_level_id' => 'required|exists:academic_levels,id',
        // ]);

        Major::create([
            'name' => [
                'ar' => $request->name_ar,
                'en' => $request->name_en,
            ],
            'academic_level_id' => $request->academic_level_id,
            'status' => $request->has('status') ? true : false,
        ]);

        return redirect()->route('admin.majors.index')
            ->with('success', 'تم إضافة التخصص بنجاح');
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
    public function edit(Major $major)
    {
        //
        $academicLevels = AcademicLevel::where('status', true)->get();
        return view('admin.majors.edit', compact('major', 'academicLevels'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(updateRequest $request, Major $major)
    {
        // //
        // $request->validate([
        //     'name_ar' => 'required|string|max:255',
        //     'name_en' => 'required|string|max:255',
        //     'academic_level_id' => 'required|exists:academic_levels,id',
        // ]);

        $major->update([
            'name' => [
                'ar' => $request->name_ar,
                'en' => $request->name_en,
            ],
            'academic_level_id' => $request->academic_level_id,
            'status' => $request->has('status') ? true : false,
        ]);

        return redirect()->route('admin.majors.index')
            ->with('success', 'تم تحديث التخصص بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Major $major)
    {
        //
        $major->delete();

        return redirect()->route('admin.majors.index')
            ->with('success', 'تم حذف التخصص بنجاح');
    }
}
