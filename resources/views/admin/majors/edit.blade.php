@extends('layouts.admin')

@section('title', 'Edit Major')
@section('page-title', 'Edit Major: ' . ($major->name['en'] ?? ''))

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Edit Major</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.majors.update', $major) }}" method="POST">
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
                               value="{{ old('name_en', $major->name['en'] ?? '') }}" 
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
                               value="{{ old('name_ar', $major->name['ar'] ?? '') }}" 
                               required
                               dir="rtl">
                        @error('name_ar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="academic_level_id" class="form-label">
                            Academic Level <span class="text-danger">*</span>
                        </label>
                        <select class="form-select @error('academic_level_id') is-invalid @enderror" 
                                id="academic_level_id" 
                                name="academic_level_id" 
                                required>
                            <option value="">Select Academic Level</option>
                            @foreach($academicLevels as $level)
                                <option value="{{ $level->id }}" 
                                    {{ old('academic_level_id', $major->academic_level_id) == $level->id ? 'selected' : '' }}>
                                    {{ $level->name['en'] ?? '' }} / {{ $level->name['ar'] ?? '' }}
                                </option>
                            @endforeach
                        </select>
                        @error('academic_level_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label d-block">Status</label>
                        <div class="form-check form-switch mt-2">
                            <input class="form-check-input" type="checkbox" id="status" name="status" 
                                   {{ old('status', $major->status) ? 'checked' : '' }}>
                            <label class="form-check-label" for="status">Active</label>
                        </div>
                    </div>
                </div>
                
                <hr>
                
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Major
                    </button>
                    <a href="{{ route('admin.majors.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection