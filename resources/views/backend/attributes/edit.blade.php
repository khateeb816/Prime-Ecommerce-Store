@extends('backend.layouts.app')

@section('title', 'Edit Attribute | Prime Admin')
@section('page-title', 'Edit Attribute')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="white-box p-4 bg-white rounded shadow-sm">
                <h3 class="box-title mb-4">Edit Attribute</h3>
                <form action="{{ route('backend.attributes.update', $attribute->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $attribute->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                        <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                            <option value="text" {{ $attribute->type == 'text' ? 'selected' : '' }}>Text</option>
                            <option value="select" {{ $attribute->type == 'select' ? 'selected' : '' }}>Select</option>
                            <option value="boolean" {{ $attribute->type == 'boolean' ? 'selected' : '' }}>Boolean</option>
                        </select>
                        @error('type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Update Attribute</button>
                    <a href="{{ route('backend.attributes.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection
