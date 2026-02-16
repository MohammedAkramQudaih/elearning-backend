<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CareerResource;
use App\Models\CareerSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CareerController extends Controller
{
    //

    public function apply(Request $request)
    {
        // قواعد التحقق
        $validator = Validator::make($request->all(), [
            'job_title' => 'required|string|max:255',
            'years_experience' => 'required|string|max:50',
            'major_id' => 'required|exists:majors,id',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'cv' => 'required|file|mimes:pdf,doc,docx|max:5120', // 5MB max
        ]);

        // إذا فشل التحقق
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
                'message' => 'Validation failed'
            ], 422);
        }

        try {
            // رفع ملف السيرة الذاتية
            $cvPath = null;
            if ($request->hasFile('cv')) {
                $cvPath = $request->file('cv')->store('cvs', 'public');
            }

            // إنشاء الطلب
            $submission = CareerSubmission::create([
                'job_title' => $request->job_title,
                'years_experience' => $request->years_experience,
                'major_id' => $request->major_id,
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'cv_path' => $cvPath,
                'status' => 'pending'
            ]);
            $submission->load('major');
            return response()->json([
                'success' => true,
                // 'data' => [
                //     // 'id' => $submission->id,
                //     // 'submission' => $submission
                    
                // ],
                'data' => new CareerResource($submission),
                'message' => 'Application submitted successfully'
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while submitting your application',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
