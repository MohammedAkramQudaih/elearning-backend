<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRequests\StoreRequest;
use App\Http\Requests\StudentRequests\updateRequest;
use App\Models\AcademicLevel;
use App\Models\Major;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $students = Student::with(['academicLevel', 'major'])->latest()->paginate(10);
        return view('admin.students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $academicLevels = AcademicLevel::where('status', true)->get();
        $majors = Major::where('status', true)->get();
        return view('admin.students.create', compact('academicLevels', 'majors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        // //
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|email|unique:students',
        //     'phone' => 'required|string|max:20',
        //     'academic_level_id' => 'required|exists:academic_levels,id',
        //     'major_id' => 'required|exists:majors,id',
        // ]);

        Student::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'academic_level_id' => $request->academic_level_id,
            'major_id' => $request->major_id,
            'status' => $request->has('status') ? true : false,
        ]);

        return redirect()->route('admin.students.index')
            ->with('success', 'تم إضافة الطالب بنجاح');
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
    public function edit(Student $student)
    {
        //
        $academicLevels = AcademicLevel::where('status', true)->get();
        $majors = Major::where('status', true)->get();
        return view('admin.students.edit', compact('student', 'academicLevels', 'majors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(updateRequest $request, Student $student)
    {
        // //
        $request->validate([
            // 'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $student->id,
            // 'phone' => 'required|string|max:20',
            // 'academic_level_id' => 'required|exists:academic_levels,id',
            // 'major_id' => 'required|exists:majors,id',
        ]);

        $student->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'academic_level_id' => $request->academic_level_id,
            'major_id' => $request->major_id,
            'status' => $request->has('status') ? true : false,
        ]);

        return redirect()->route('admin.students.index')
            ->with('success', 'تم تحديث بيانات الطالب بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        //
        $student->delete();

        return redirect()->route('admin.students.index')
            ->with('success', 'تم حذف الطالب بنجاح');
    }
}
