@extends('layouts.admin')

@section('title', 'Majors')
@section('page-title', 'Majors Management')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">All Majors</h5>
            <a href="{{ route('admin.majors.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add New Major
            </a>
        </div>
        <div class="card-body">
            @if($majors->isEmpty())
                <div class="alert alert-info">
                    No majors found. <a href="{{ route('admin.majors.create') }}">Create your first major</a>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th width="50">ID</th>
                                <th>Name (English)</th>
                                <th>Name (Arabic)</th>
                                <th>Academic Level</th>
                                <th width="100">Status</th>
                                <th width="150">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($majors as $major)
                                <tr>
                                    <td>{{ $major->id }}</td>
                                    <td>{{ $major->name['en'] ?? 'N/A' }}</td>
                                    <td>{{ $major->name['ar'] ?? 'N/A' }}</td>
                                    <td>
                                        @if($major->academicLevel)
                                            <span class="badge bg-info">
                                                {{ $major->academicLevel->name['en'] ?? '' }}
                                            </span>
                                        @else
                                            <span class="badge bg-secondary">N/A</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($major->status)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.majors.edit', $major) }}" class="btn btn-sm btn-warning" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.majors.destroy', $major) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this major?');">
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
                    {{ $majors->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection