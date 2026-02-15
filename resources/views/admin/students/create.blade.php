@extends('layouts.admin')

@section('title', 'Create Student')
@section('page-title', 'Add New Student')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Student Information</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.students.store') }}" method="POST">
                @csrf
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">
                            Full Name <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               class="form-control @error('name') is-invalid @enderror" 
                               id="name" 
                               name="name" 
                               value="{{ old('name') }}" 
                               required
                               placeholder="Enter student's full name">
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
                               value="{{ old('email') }}" 
                               required
                               placeholder="student@example.com">
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
                               value="{{ old('phone') }}" 
                               required
                               placeholder="+1234567890">
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
                                <option value="{{ $level->id }}" {{ old('academic_level_id') == $level->id ? 'selected' : '' }}>
                                    {{ $level->name['en'] ?? '' }} / {{ $level->name['ar'] ?? '' }}
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
                                <option value="{{ $major->id }}" {{ old('major_id') == $major->id ? 'selected' : '' }}>
                                    {{ $major->name['en'] ?? '' }} / {{ $major->name['ar'] ?? '' }}
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
                            <input class="form-check-input" type="checkbox" id="status" name="status" checked>
                            <label class="form-check-label" for="status">Active</label>
                        </div>
                    </div>
                </div>
                
                <hr>
                
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Save Student
                    </button>
                    <a href="{{ route('admin.students.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
        // تحديث قائمة التخصصات عند تغيير المستوى الأكاديمي
        document.getElementById('academic_level_id').addEventListener('change', function() {
            const academicLevelId = this.value;
            const majorSelect = document.getElementById('major_id');
            
            if (academicLevelId) {
                fetch(`/api/majors?academic_level_id=${academicLevelId}`)
                    .then(response => response.json())
                    .then(data => {
                        majorSelect.innerHTML = '<option value="">Select Major</option>';
                        data.data.forEach(major => {
                            majorSelect.innerHTML += `<option value="${major.id}">${major.name}</option>`;
                        });
                    });
            } else {
                majorSelect.innerHTML = '<option value="">Select Major</option>';
            }
        });
    </script>
    @endpush
@endsection