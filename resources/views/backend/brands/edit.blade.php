@extends('backend.layouts.app')

@section('title', 'Edit Brand | Prime Admin')
@section('page-title', 'Edit Brand')

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="white-box p-4 bg-white rounded shadow-sm">
                <form method="POST" action="{{ route('backend.brands.update', $brand->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label class="form-label">Brand Name *</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name', $brand->name) }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Categories *</label>
                        <select class="form-control" name="categories[]" multiple required style="height: 150px;">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $brand->categories->contains($category->id) ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <small class="text-muted">Hold Ctrl/Cmd to select multiple categories.</small>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Icon</label>
                         @if($brand->icon)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $brand->icon) }}" alt="Icon" width="50">
                            </div>
                        @endif
                        <input type="file" class="form-control" name="icon" accept="image/*">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description" rows="4">{{ old('description', $brand->description) }}</textarea>
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="show_on_homepage" name="show_on_homepage" {{ $brand->show_on_homepage ? 'checked' : '' }}>
                        <label class="form-check-label" for="show_on_homepage">Show on Homepage</label>
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
