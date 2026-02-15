@extends('layouts.admin')

@section('title', 'Create News')
@section('page-title', 'Add News Article')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">News Article Information</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="title_en" class="form-label">
                            Title (English) <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               class="form-control @error('title_en') is-invalid @enderror" 
                               id="title_en" 
                               name="title_en" 
                               value="{{ old('title_en') }}" 
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
                               value="{{ old('title_ar') }}" 
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
                               value="{{ old('date', date('Y-m-d')) }}" 
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
                        <small class="text-muted">Accepted formats: JPEG, PNG, JPG, GIF (Max: 2MB)</small>
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
                                  required>{{ old('content_en') }}</textarea>
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
                                  dir="rtl">{{ old('content_ar') }}</textarea>
                        @error('content_ar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="status" name="status" checked>
                        <label class="form-check-label" for="status">Publish</label>
                    </div>
                </div>
                
                <hr>
                
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Save News
                    </button>
                    <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection