@extends('layouts.admin')

@section('title', 'Career Submissions')
@section('page-title', 'Career Submissions Management')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">All Career Submissions</h5>
            <div>
                <a href="{{ route('admin.career-submissions.index', ['status' => 'pending']) }}" class="btn btn-sm btn-warning">Pending</a>
                <a href="{{ route('admin.career-submissions.index', ['status' => 'approved']) }}" class="btn btn-sm btn-success">Approved</a>
                <a href="{{ route('admin.career-submissions.index', ['status' => 'rejected']) }}" class="btn btn-sm btn-danger">Rejected</a>
                <a href="{{ route('admin.career-submissions.index') }}" class="btn btn-sm btn-secondary">All</a>
            </div>
        </div>
        <div class="card-body">
            @if($submissions->isEmpty())
                <div class="alert alert-info">
                    No career submissions found.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th width="50">ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Job Title</th>
                                <th>Major</th>
                                <th>Experience</th>
                                <th>Status</th>
                                <th>Submitted</th>
                                <th width="200">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($submissions as $submission)
                                <tr>
                                    <td>{{ $submission->id }}</td>
                                    <td>{{ $submission->name }}</td>
                                    <td>{{ $submission->email }}</td>
                                    <td>{{ $submission->phone }}</td>
                                    <td>{{ $submission->job_title }}</td>
                                    <td>{{ $submission->major->name['en'] ?? 'N/A' }}</td>
                                    <td>{{ $submission->years_experience }}</td>
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
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.career-submissions.show', $submission) }}" class="btn btn-sm btn-info" title="View Details">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            
                                            @if($submission->cv_path)
                                                <a href="{{ route('admin.career-submissions.download-cv', $submission) }}" class="btn btn-sm btn-success" title="Download CV">
                                                    <i class="fas fa-download"></i>
                                                </a>
                                            @endif
                                            
                                            <form action="{{ route('admin.career-submissions.destroy', $submission) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this submission?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-3">
                    {{ $submissions->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection