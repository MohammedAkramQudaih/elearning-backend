@extends('layouts.admin')

@section('title', 'Create Major')
@section('page-title', 'Create New Major')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Major Information</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.majors.store') }}" method="POST">
                @csrf
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name_en" class="form-label">
                            Name (English) <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               class="form-control @error('name_en') is-invalid @enderror" 
                               id="name_en" 
                               name="name_en" 
                               value="{{ old('name_en') }}" 
                               required
                               placeholder="e.g., Computer Science">
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
                               value="{{ old('name_ar') }}" 
                               required
                               placeholder="مثال: علوم الحاسب"
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
                                <option value="{{ $level->id }}" {{ old('academic_level_id') == $level->id ? 'selected' : '' }}>
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
                            <input class="form-check-input" type="checkbox" id="status" name="status" checked>
                            <label class="form-check-label" for="status">Active</label>
                        </div>
                    </div>
                </div>
                
                <hr>
                
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Save Major
                    </button>
                    <a href="{{ route('admin.majors.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection