@extends('layouts.admin')

@section('title', 'Create Academic Level')
@section('page-title', 'Create New Academic Level')

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.academic-levels.store') }}" method="POST">
                @csrf
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name_en" class="form-label">Name (English) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name_en') is-invalid @enderror" 
                               id="name_en" name="name_en" value="{{ old('name_en') }}" required>
                        @error('name_en')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="name_ar" class="form-label">Name (Arabic) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name_ar') is-invalid @enderror" 
                               id="name_ar" name="name_ar" value="{{ old('name_ar') }}" required>
                        @error('name_ar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="status" name="status" checked>
                    <label class="form-check-label" for="status">Active</label>
                </div>
                
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Save
                    </button>
                    <a href="{{ route('admin.academic-levels.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection