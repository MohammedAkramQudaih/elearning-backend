<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MajorResource;
use App\Models\Major;
use Illuminate\Http\Request;

class MajorController extends Controller
{
    //
    public function index(Request $request)
    {
        $query = Major::with('academicLevel')->where('status', true);
        
        // فلترة حسب المستوى الأكاديمي إذا وجد
        if ($request->has('academic_level_id')) {
            $query->where('academic_level_id', $request->academic_level_id);
        }
        
        $majors = $query->get();
        
        return response()->json([
            'success' => true,
            'data' => MajorResource::collection($majors),
            'message' => 'Majors retrieved successfully'
        ]);
    }
}
