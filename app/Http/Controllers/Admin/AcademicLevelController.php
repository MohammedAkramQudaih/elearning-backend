<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AcademicLevelRequest\StoreRequest;
use App\Http\Requests\AcademicLevelRequest\UpdateRequest;
use App\Http\Requests\StoreAcademicLevelRequest;
use App\Models\AcademicLevel;
use Illuminate\Http\Request;

class AcademicLevelController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $academicLevels = AcademicLevel::latest()->paginate(10);
        return view('admin.academic-levels.index', compact('academicLevels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.academic-levels.create');
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
        // ]);

        AcademicLevel::create([
            'name' => [
                'ar' => $request->name_ar,
                'en' => $request->name_en,
            ],
            'status' => $request->has('status') ? true : false,
        ]);

        return redirect()->route('admin.academic-levels.index')
            ->with('success', 'تم إضافة المستوى الأكاديمي بنجاح');
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
    public function edit(AcademicLevel $academicLevel)
    {
        //
        return view('admin.academic-levels.edit', compact('academicLevel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, AcademicLevel $academicLevel)
    {
        //
        // $request->validate([
        //     'name_ar' => 'required|string|max:255',
        //     'name_en' => 'required|string|max:255',
        // ]);

        $academicLevel->update([
            'name' => [
                'ar' => $request->name_ar,
                'en' => $request->name_en,
            ],
            'status' => $request->has('status') ? true : false,
        ]);

        return redirect()->route('admin.academic-levels.index')
            ->with('success', 'تم تحديث المستوى الأكاديمي بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AcademicLevel $academicLevel)
    {
        //
        $academicLevel->delete();

        return redirect()->route('admin.academic-levels.index')
            ->with('success', 'تم حذف المستوى الأكاديمي بنجاح');
    }
}
