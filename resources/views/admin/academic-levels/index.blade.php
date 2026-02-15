@extends('layouts.admin')

@section('title', 'Academic Levels')
@section('page-title', 'Academic Levels Management')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>All Academic Levels</h5>
            <a href="{{ route('admin.academic-levels.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add New Level
            </a>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name (English)</th>
                        <th>Name (Arabic)</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($academicLevels as $level)
                        <tr>
                            <td>{{ $level->id }}</td>
                            <td>{{ $level->name['en'] ?? '' }}</td>
                            <td>{{ $level->name['ar'] ?? '' }}</td>
                            <td>
                                @if ($level->status)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.academic-levels.edit', $level) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.academic-levels.destroy', $level) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-3">
                {{ $academicLevels->links() }}
            </div>
        </div>
    </div>
@endsection
