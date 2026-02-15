@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
    <div class="row">
        <!-- بطاقة إحصائيات المستويات الأكاديمية -->
        <div class="col-md-4 mb-4">
            <div class="card bg-primary text-white h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title">Academic Levels</h6>
                        <h2 class="mb-0">{{ \App\Models\AcademicLevel::count() }}</h2>
                    </div>
                    <i class="fas fa-layer-group fa-3x opacity-50"></i>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a href="{{ route('admin.academic-levels.index') }}" class="text-white text-decoration-none">View Details</a>
                    <i class="fas fa-angle-right"></i>
                </div>
            </div>
        </div>

        <!-- بطاقة إحصائيات التخصصات -->
        <div class="col-md-4 mb-4">
            <div class="card bg-success text-white h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title">Majors</h6>
                        <h2 class="mb-0">{{ \App\Models\Major::count() }}</h2>
                    </div>
                    <i class="fas fa-book fa-3x opacity-50"></i>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a href="{{ route('admin.majors.index') }}" class="text-white text-decoration-none">View Details</a>
                    <i class="fas fa-angle-right"></i>
                </div>
            </div>
        </div>

        <!-- بطاقة إحصائيات الطلاب -->
        <div class="col-md-4 mb-4">
            <div class="card bg-info text-white h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title">Students</h6>
                        <h2 class="mb-0">{{ \App\Models\Student::count() }}</h2>
                    </div>
                    <i class="fas fa-users fa-3x opacity-50"></i>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a href="{{ route('admin.students.index') }}" class="text-white text-decoration-none">View Details</a>
                    <i class="fas fa-angle-right"></i>
                </div>
            </div>
        </div>

        <!-- بطاقة إحصائيات الشهادات -->
        <div class="col-md-4 mb-4">
            <div class="card bg-warning text-white h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title">Testimonials</h6>
                        <h2 class="mb-0">{{ \App\Models\Testimonial::count() }}</h2>
                    </div>
                    <i class="fas fa-star fa-3x opacity-50"></i>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a href="{{ route('admin.testimonials.index') }}" class="text-white text-decoration-none">View Details</a>
                    <i class="fas fa-angle-right"></i>
                </div>
            </div>
        </div>

        <!-- بطاقة إحصائيات الأخبار -->
        <div class="col-md-4 mb-4">
            <div class="card bg-danger text-white h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title">News</h6>
                        <h2 class="mb-0">{{ \App\Models\News::count() }}</h2>
                    </div>
                    <i class="fas fa-newspaper fa-3x opacity-50"></i>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a href="{{ route('admin.news.index') }}" class="text-white text-decoration-none">View Details</a>
                    <i class="fas fa-angle-right"></i>
                </div>
            </div>
        </div>

        <!-- بطاقة إحصائيات طلبات التوظيف -->
        <div class="col-md-4 mb-4">
            <div class="card bg-secondary text-white h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title">Career Submissions</h6>
                        <h2 class="mb-0">{{ \App\Models\CareerSubmission::count() }}</h2>
                    </div>
                    <i class="fas fa-briefcase fa-3x opacity-50"></i>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a href="{{ route('admin.career-submissions.index') }}" class="text-white text-decoration-none">View Details</a>
                    <i class="fas fa-angle-right"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- قسم آخر الطلبات المقدمة -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Latest Career Submissions</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Job Title</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(\App\Models\CareerSubmission::with('major')->latest()->limit(5)->get() as $submission)
                                <tr>
                                    <td>{{ $submission->name }}</td>
                                    <td>{{ $submission->job_title }}</td>
                                    <td>{{ $submission->email }}</td>
                                    <td>
                                        @if($submission->status == 'pending')
                                            <span class="badge bg-warning">Pending</span>
                                        @elseif($submission->status == 'approved')
                                            <span class="badge bg-success">Approved</span>
                                        @else
                                            <span class="badge bg-danger">Rejected</span>
                                        @endif
                                    </td>
                                    <td>{{ $submission->created_at->format('Y-m-d') }}</td>
                                    <td>
                                        <a href="{{ route('admin.career-submissions.show', $submission) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i> View
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection