@extends('layouts.admin')

@section('title', 'Create Testimonial')
@section('page-title', 'Add New Testimonial')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Testimonial Information</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">
                            Person Name <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               class="form-control @error('name') is-invalid @enderror" 
                               id="name" 
                               name="name" 
                               value="{{ old('name') }}" 
                               required
                               placeholder="e.g., John Doe">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="image" class="form-label">Profile Image</label>
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
                        <label for="position_en" class="form-label">
                            Position (English) <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               class="form-control @error('position_en') is-invalid @enderror" 
                               id="position_en" 
                               name="position_en" 
                               value="{{ old('position_en') }}" 
                               required
                               placeholder="e.g., Software Engineer">
                        @error('position_en')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="position_ar" class="form-label">
                            Position (Arabic) <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               class="form-control @error('position_ar') is-invalid @enderror" 
                               id="position_ar" 
                               name="position_ar" 
                               value="{{ old('position_ar') }}" 
                               required
                               placeholder="مثال: مهندس برمجيات"
                               dir="rtl">
                        @error('position_ar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="content_en" class="form-label">
                            Testimonial Content (English) <span class="text-danger">*</span>
                        </label>
                        <textarea class="form-control @error('content_en') is-invalid @enderror" 
                                  id="content_en" 
                                  name="content_en" 
                                  rows="4" 
                                  required>{{ old('content_en') }}</textarea>
                        @error('content_en')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="content_ar" class="form-label">
                            Testimonial Content (Arabic) <span class="text-danger">*</span>
                        </label>
                        <textarea class="form-control @error('content_ar') is-invalid @enderror" 
                                  id="content_ar" 
                                  name="content_ar" 
                                  rows="4" 
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
                        <label class="form-check-label" for="status">Active</label>
                    </div>
                </div>
                
                <hr>
                
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Save Testimonial
                    </button>
                    <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection