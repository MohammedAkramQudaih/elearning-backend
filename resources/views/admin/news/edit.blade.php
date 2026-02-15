@extends('layouts.admin')

@section('title', 'Edit News')
@section('page-title', 'Edit News Article')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Edit News Article</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.news.update', $news) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="title_en" class="form-label">
                            Title (English) <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               class="form-control @error('title_en') is-invalid @enderror" 
                               id="title_en" 
                               name="title_en" 
                               value="{{ old('title_en', $news->title['en'] ?? '') }}" 
                               required>
                        @error('title_en')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="title_ar" class="form-label">
                            Title (Arabic) <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               class="form-control @error('title_ar') is-invalid @enderror" 
                               id="title_ar" 
                               name="title_ar" 
                               value="{{ old('title_ar', $news->title['ar'] ?? '') }}" 
                               required
                               dir="rtl">
                        @error('title_ar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="date" class="form-label">
                            Publication Date <span class="text-danger">*</span>
                        </label>
                        <input type="date" 
                               class="form-control @error('date') is-invalid @enderror" 
                               id="date" 
                               name="date" 
                               value="{{ old('date', $news->date->format('Y-m-d')) }}" 
                               required>
                        @error('date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="image" class="form-label">Featured Image</label>
                        <input type="file" 
                               class="form-control @error('image') is-invalid @enderror" 
                               id="image" 
                               name="image" 
                               accept="image/*">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        
                        @if($news->image)
                            <div class="mt-2">
                                <p>Current Image:</p>
                                <img src="{{ Storage::url($news->image) }}" 
                                     alt="{{ $news->title['en'] ?? '' }}"
                                     style="width: 100px; height: 100px; object-fit: cover; border-radius: 5px;">
                            </div>
                        @endif
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="content_en" class="form-label">
                            Content (English) <span class="text-danger">*</span>
                        </label>
                        <textarea class="form-control @error('content_en') is-invalid @enderror" 
                                  id="content_en" 
                                  name="content_en" 
                                  rows="6" 
                                  required>{{ old('content_en', $news->content['en'] ?? '') }}</textarea>
                        @error('content_en')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="content_ar" class="form-label">
                            Content (Arabic) <span class="text-danger">*</span>
                        </label>
                        <textarea class="form-control @error('content_ar') is-invalid @enderror" 
                                  id="content_ar" 
                                  name="content_ar" 
                                  rows="6" 
                                  required
                                  dir="rtl">{{ old('content_ar', $news->content['ar'] ?? '') }}</textarea>
                        @error('content_ar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="status" name="status" 
                               {{ old('status', $news->status) ? 'checked' : '' }}>
                        <label class="form-check-label" for="status">Published</label>
                    </div>
                </div>
                
                <hr>
                
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update News
                    </button>
                    <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection