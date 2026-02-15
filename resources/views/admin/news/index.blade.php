@extends('layouts.admin')

@section('title', 'News')
@section('page-title', 'News Management')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">All News</h5>
            <a href="{{ route('admin.news.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add News
            </a>
        </div>
        <div class="card-body">
            @if($news->isEmpty())
                <div class="alert alert-info">
                    No news found. <a href="{{ route('admin.news.create') }}">Add your first news article</a>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th width="50">ID</th>
                                <th>Image</th>
                                <th>Title (English)</th>
                                <th>Title (Arabic)</th>
                                <th>Date</th>
                                <th width="100">Status</th>
                                <th width="150">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($news as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>
                                        @if($item->image)
                                            <img src="{{ Storage::url($item->image) }}" 
                                                 alt="{{ $item->title['en'] ?? '' }}"
                                                 style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">
                                        @else
                                            <div class="bg-secondary text-white d-flex align-items-center justify-content-center" 
                                                 style="width: 50px; height: 50px; border-radius: 5px;">
                                                <i class="fas fa-image"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>{{ Str::limit($item->title['en'] ?? '', 50) }}</td>
                                    <td>{{ Str::limit($item->title['ar'] ?? '', 50) }}</td>
                                    <td>{{ $item->date->format('Y-m-d') }}</td>
                                    <td>
                                        @if($item->status)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.news.edit', $item) }}" class="btn btn-sm btn-warning" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.news.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this news article?');">
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
                    {{ $news->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection