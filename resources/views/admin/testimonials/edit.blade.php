@extends('layouts.admin')

@section('title', 'Edit Testimonial')
@section('page-title', 'Edit Testimonial: ' . $testimonial->name)

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Edit Testimonial</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.testimonials.update', $testimonial) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">
                            Person Name <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               class="form-control @error('name') is-invalid @enderror" 
                               id="name" 
                               name="name" 
                               value="{{ old('name', $testimonial->name) }}" 
                               required>
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
                        
                        @if($testimonial->image)
                            <div class="mt-2">
                                <p>Current Image:</p>
                                <img src="{{ Storage::url($testimonial->image) }}" 
                                     alt="{{ $testimonial->name }}"
                                     style="width: 100px; height: 100px; object-fit: cover; border-radius: 10px;">
                            </div>
                        @endif
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
                               value="{{ old('position_en', $testimonial->position['en'] ?? '') }}" 
                               required>
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
                               value="{{ old('position_ar', $testimonial->position['ar'] ?? '') }}" 
                               required
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
                                  required>{{ old('content_en', $testimonial->content['en'] ?? '') }}</textarea>
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
                                  dir="rtl">{{ old('content_ar', $testimonial->content['ar'] ?? '') }}</textarea>
                        @error('content_ar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="status" name="status" 
                               {{ old('status', $testimonial->status) ? 'checked' : '' }}>
                        <label class="form-check-label" for="status">Active</label>
                    </div>
                </div>
                
                <hr>
                
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Testimonial
                    </button>
                    <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection