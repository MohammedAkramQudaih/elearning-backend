@extends('layouts.admin')

@section('title', 'Testimonials')
@section('page-title', 'Testimonials Management')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">All Testimonials</h5>
            <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add New Testimonial
            </a>
        </div>
        <div class="card-body">
            @if($testimonials->isEmpty())
                <div class="alert alert-info">
                    No testimonials found. <a href="{{ route('admin.testimonials.create') }}">Add your first testimonial</a>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th width="50">ID</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Position (English)</th>
                                <th>Position (Arabic)</th>
                                <th width="100">Status</th>
                                <th width="150">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($testimonials as $testimonial)
                                <tr>
                                    <td>{{ $testimonial->id }}</td>
                                    <td>
                                        @if($testimonial->image)
                                            <img src="{{ Storage::url($testimonial->image) }}" 
                                                 alt="{{ $testimonial->name }}"
                                                 style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;">
                                        @else
                                            <div class="bg-secondary text-white d-flex align-items-center justify-content-center" 
                                                 style="width: 50px; height: 50px; border-radius: 50%;">
                                                <i class="fas fa-user"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>{{ $testimonial->name }}</td>
                                    <td>{{ $testimonial->position['en'] ?? 'N/A' }}</td>
                                    <td>{{ $testimonial->position['ar'] ?? 'N/A' }}</td>
                                    <td>
                                        @if($testimonial->status)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="btn btn-sm btn-warning" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.testimonials.destroy', $testimonial) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this testimonial?');">
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
                    {{ $testimonials->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection