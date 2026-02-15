@extends('layouts.admin')

@section('title', 'Career Submission Details')
@section('page-title', 'Career Submission #' . $careerSubmission->id)

@section('content')
    <div class="row">
        <div class="col-md-8">
            <!-- Applicant Information -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Applicant Information</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th style="width: 200px;">Full Name</th>
                            <td>{{ $careerSubmission->name }}</td>
                        </tr>
                        <tr>
                            <th>Email Address</th>
                            <td>
                                <a href="mailto:{{ $careerSubmission->email }}">{{ $careerSubmission->email }}</a>
                            </td>
                        </tr>
                        <tr>
                            <th>Phone Number</th>
                            <td>
                                <a href="tel:{{ $careerSubmission->phone }}">{{ $careerSubmission->phone }}</a>
                            </td>
                        </tr>
                        <tr>
                            <th>Job Title Applied</th>
                            <td>{{ $careerSubmission->job_title }}</td>
                        </tr>
                        <tr>
                            <th>Years of Experience</th>
                            <td>{{ $careerSubmission->years_experience }}</td>
                        </tr>
                        <tr>
                            <th>Major</th>
                            <td>
                                @if($careerSubmission->major)
                                    {{ $careerSubmission->major->name['en'] ?? '' }} / 
                                    {{ $careerSubmission->major->name['ar'] ?? '' }}
                                @else
                                    <span class="text-muted">N/A</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Current Status</th>
                            <td>
                                @if($careerSubmission->status == 'pending')
                                    <span class="badge bg-warning fs-6">Pending</span>
                                @elseif($careerSubmission->status == 'approved')
                                    <span class="badge bg-success fs-6">Approved</span>
                                @else
                                    <span class="badge bg-danger fs-6">Rejected</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Submitted On</th>
                            <td>{{ $careerSubmission->created_at->format('F d, Y - h:i A') }}</td>
                        </tr>
                        <tr>
                            <th>Last Updated</th>
                            <td>{{ $careerSubmission->updated_at->format('F d, Y - h:i A') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <!-- Update Status Card -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Update Status</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.career-submissions.update-status', $careerSubmission) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="status" class="form-label">Change Status</label>
                            <select class="form-select" id="status" name="status">
                                <option value="pending" {{ $careerSubmission->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="approved" {{ $careerSubmission->status == 'approved' ? 'selected' : '' }}>Approved</option>
                                <option value="rejected" {{ $careerSubmission->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-sync-alt"></i> Update Status
                        </button>
                    </form>
                </div>
            </div>
            
            <!-- CV Card -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Resume/CV</h5>
                </div>
                <div class="card-body">
                    @if($careerSubmission->cv_path)
                        <div class="text-center mb-3">
                            <i class="fas fa-file-pdf fa-4x text-danger"></i>
                            <p class="mt-2">Resume File</p>
                        </div>
                        <a href="{{ route('admin.career-submissions.download-cv', $careerSubmission) }}" class="btn btn-success w-100">
                            <i class="fas fa-download"></i> Download CV
                        </a>
                    @else
                        <div class="alert alert-warning mb-0">
                            <i class="fas fa-exclamation-triangle"></i> No CV uploaded
                        </div>
                    @endif
                </div>
            </div>
            
            <!-- Actions Card -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Actions</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="mailto:{{ $careerSubmission->email }}" class="btn btn-info">
                            <i class="fas fa-envelope"></i> Send Email
                        </a>
                        <a href="tel:{{ $careerSubmission->phone }}" class="btn btn-secondary">
                            <i class="fas fa-phone"></i> Call Applicant
                        </a>
                        <form action="{{ route('admin.career-submissions.destroy', $careerSubmission) }}" method="POST" 
                              onsubmit="return confirm('Are you sure you want to delete this submission?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-100">
                                <i class="fas fa-trash"></i> Delete Submission
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="mt-3">
        <a href="{{ route('admin.career-submissions.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to List
        </a>
    </div>
@endsection