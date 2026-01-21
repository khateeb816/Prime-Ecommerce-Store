@extends('backend.layouts.app')

@section('title', 'Create Attribute | Prime Admin')
@section('page-title', 'Create Attribute')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="white-box p-4 bg-white rounded shadow-sm">
                <h3 class="box-title mb-4">Add New Attribute</h3>
                <form action="{{ route('backend.attributes.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                        <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                            <option value="text">Text</option>
                            <option value="select">Select</option>
                            <option value="boolean">Boolean</option>
                        </select>
                        @error('type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Create Attribute</button>
                    <a href="{{ route('backend.attributes.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection
