@extends('backend.layouts.app')

@section('title', 'Edit Brand | Prime Admin')
@section('page-title', 'Edit Brand')

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="white-box">
                <form method="POST" action="{{ route('backend.brands.update', $id) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Brand Name *</label>
                        <input type="text" class="form-control" name="name" value="Brand Name" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description" rows="4">Brand description here...</textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select class="form-select" name="status">
                            <option value="active" selected>Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Update Brand</button>
                        <a href="{{ route('backend.brands.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

