@extends('layouts.admin')

@section('title', 'Edit Academic Level')
@section('page-title', 'Edit Academic Level: ' . ($academicLevel->name['en'] ?? ''))

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Edit Academic Level</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.academic-levels.update', $academicLevel) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name_en" class="form-label">
                            Name (English) <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               class="form-control @error('name_en') is-invalid @enderror" 
                               id="name_en" 
                               name="name_en" 
                               value="{{ old('name_en', $academicLevel->name['en'] ?? '') }}" 
                               required>
                        @error('name_en')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="name_ar" class="form-label">
                            Name (Arabic) <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               class="form-control @error('name_ar') is-invalid @enderror" 
                               id="name_ar" 
                               name="name_ar" 
                               value="{{ old('name_ar', $academicLevel->name['ar'] ?? '') }}" 
                               required
                               dir="rtl">
                        @error('name_ar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="status" name="status" 
                               {{ old('status', $academicLevel->status) ? 'checked' : '' }}>
                        <label class="form-check-label" for="status">Active</label>
                    </div>
                </div>
                
                <hr>
                
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Level
                    </button>
                    <a href="{{ route('admin.academic-levels.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection