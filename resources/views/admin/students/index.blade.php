@extends('layouts.admin')

@section('title', 'Students')
@section('page-title', 'Students Management')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">All Students</h5>
            <a href="{{ route('admin.students.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add New Student
            </a>
        </div>
        <div class="card-body">
            @if($students->isEmpty())
                <div class="alert alert-info">
                    No students found. <a href="{{ route('admin.students.create') }}">Add your first student</a>
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
                                <th>Academic Level</th>
                                <th>Major</th>
                                <th width="100">Status</th>
                                <th width="150">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $student)
                                <tr>
                                    <td>{{ $student->id }}</td>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->email }}</td>
                                    <td>{{ $student->phone }}</td>
                                    <td>
                                        @if($student->academicLevel)
                                            {{ $student->academicLevel->name['en'] ?? '' }}
                                        @else
                                            <span class="badge bg-secondary">N/A</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($student->major)
                                            {{ $student->major->name['en'] ?? '' }}
                                        @else
                                            <span class="badge bg-secondary">N/A</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($student->status)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.students.edit', $student) }}" class="btn btn-sm btn-warning" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.students.destroy', $student) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this student?');">
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
                    {{ $students->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection