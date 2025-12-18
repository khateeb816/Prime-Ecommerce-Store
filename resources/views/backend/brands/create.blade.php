@extends('backend.layouts.app')

@section('title', 'Add Brand | Prime Admin')
@section('page-title', 'Add Brand')

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="white-box">
                <form method="POST" action="{{ route('backend.brands.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Brand Name *</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description" rows="4"></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select class="form-select" name="status">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Save Brand</button>
                        <a href="{{ route('backend.brands.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

