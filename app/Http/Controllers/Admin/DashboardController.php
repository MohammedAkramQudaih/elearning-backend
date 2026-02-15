<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcademicLevel;
use App\Models\CareerSubmission;
use App\Models\Major;
use App\Models\News;
use App\Models\Student;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //

    public function index()
    {

        // $students = Student::get();
        // $academicLevels = AcademicLevel::get();
        // $careerSubmissions = CareerSubmission::get();
        // $majors = Major::get();
        // $news = News::get();
        // $testimonials = Testimonial::get();

        // return view('admin.index', compact('students', 'academicLevels', 'careerSubmissions', 'majors', 'news', 'testimonials'));
        return view('admin.index', );
    }
}
