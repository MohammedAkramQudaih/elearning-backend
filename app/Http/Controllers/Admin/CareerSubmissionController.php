<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CareerSubmissionRequest\updateStatusRequest;
use App\Models\CareerSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CareerSubmissionController extends Controller
{
    //
    public function index()
    {
        $submissions = CareerSubmission::with('major')->latest()->paginate(10);
        return view('admin.career-submissions.index', compact('submissions'));
    }

    public function show(CareerSubmission $careerSubmission)
    {
        return view('admin.career-submissions.show', compact('careerSubmission'));
    }

    public function updateStatus(updateStatusRequest $request, CareerSubmission $careerSubmission)
    {
        // $request->validate([
        //     'status' => 'required|in:pending,approved,rejected',
        // ]);

        $careerSubmission->update([
            'status' => $request->status
        ]);

        return redirect()->route('admin.career-submissions.index')
            ->with('success', 'تم تحديث حالة الطلب بنجاح');
    }


    public function downloadCV(CareerSubmission $careerSubmission)
    {
        if (!$careerSubmission->cv_path) {
            return redirect()->back()->with('error', 'لا يوجد ملف سيرة ذاتية');
        }

        return Storage::disk('public')->download($careerSubmission->cv_path);
    }

    public function destroy(CareerSubmission $careerSubmission)
    {
        // حذف ملف السيرة الذاتية
        if ($careerSubmission->cv_path) {
            Storage::disk('public')->delete($careerSubmission->cv_path);
        }

        $careerSubmission->delete();

        return redirect()->route('admin.career-submissions.index')
            ->with('success', 'تم حذف الطلب بنجاح');
    }
}
