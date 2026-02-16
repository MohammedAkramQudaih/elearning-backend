@extends('layouts.admin')

@section('title', 'Edit Student')
@section('page-title', 'Edit Student: ' . $student->name)

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Edit Student Information</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.students.update', $student) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">
                            Full Name <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               class="form-control @error('name') is-invalid @enderror" 
                               id="name" 
                               name="name" 
                               value="{{ old('name', $student->name) }}" 
                               required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">
                            Email Address <span class="text-danger">*</span>
                        </label>
                        <input type="email" 
                               class="form-control @error('email') is-invalid @enderror" 
                               id="email" 
                               name="email" 
                               value="{{ old('email', $student->email) }}" 
                               required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="phone" class="form-label">
                            Phone Number <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               class="form-control @error('phone') is-invalid @enderror" 
                               id="phone" 
                               name="phone" 
                               value="{{ old('phone', $student->phone) }}" 
                               required>
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
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
                                @php
                                    // تحويل اسم المستوى من JSON إلى array إذا كان string
                                    $levelNameEn = '';
                                    $levelNameAr = '';
                                    
                                    if ($level->name) {
                                        $levelData = is_string($level->name) 
                                            ? json_decode($level->name, true) 
                                            : $level->name;
                                        
                                        $levelNameEn = is_array($levelData) ? ($levelData['en'] ?? '') : $levelData;
                                        $levelNameAr = is_array($levelData) ? ($levelData['ar'] ?? '') : $levelData;
                                    }
                                @endphp
                                <option value="{{ $level->id }}" 
                                    {{ old('academic_level_id', $student->academic_level_id) == $level->id ? 'selected' : '' }}>
                                    {{ $levelNameEn }} / {{ $levelNameAr }}
                                </option>
                            @endforeach
                        </select>
                        @error('academic_level_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="major_id" class="form-label">
                            Major <span class="text-danger">*</span>
                        </label>
                        <select class="form-select @error('major_id') is-invalid @enderror" 
                                id="major_id" 
                                name="major_id" 
                                required>
                            <option value="">Select Major</option>
                            @foreach($majors as $major)
                                @php
                                    // تحويل اسم التخصص من JSON إلى array إذا كان string
                                    $majorNameEn = '';
                                    $majorNameAr = '';
                                    
                                    if ($major->name) {
                                        $majorData = is_string($major->name) 
                                            ? json_decode($major->name, true) 
                                            : $major->name;
                                        
                                        $majorNameEn = is_array($majorData) ? ($majorData['en'] ?? '') : $majorData;
                                        $majorNameAr = is_array($majorData) ? ($majorData['ar'] ?? '') : $majorData;
                                    }
                                @endphp
                                <option value="{{ $major->id }}" 
                                    {{ old('major_id', $student->major_id) == $major->id ? 'selected' : '' }}>
                                    {{ $majorNameEn }} / {{ $majorNameAr }}
                                </option>
                            @endforeach
                        </select>
                        @error('major_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label d-block">Status</label>
                        <div class="form-check form-switch mt-2">
                            <input class="form-check-input" type="checkbox" id="status" name="status" 
                                   {{ old('status', $student->status) ? 'checked' : '' }}>
                            <label class="form-check-label" for="status">Active</label>
                        </div>
                    </div>
                </div>
                
                <hr>
                
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Student
                    </button>
                    <a href="{{ route('admin.students.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection