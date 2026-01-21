@extends('backend.layouts.app')

@section('title', 'Categories | Prime Admin')
@section('page-title', 'Categories')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="white-box p-4 bg-white rounded shadow-sm">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="box-title mb-0">All Categories</h3>
                    <a href="{{ route('backend.categories.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-2"></i>Add New Category
                    </a>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Icon</th>
                                <th>Name</th>
                                <th>Show on Home</th>
                                <th>Filters</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>
                                        <i class="bi {{ $category->icon ?: 'bi-grid' }} fs-4 text-brand-blue"></i>
                                    </td>
                                    <td><strong>{{ $category->name }}</strong></td>
                                    <td>
                                        @if($category->show_on_homepage)
                                            <span class="badge bg-success">Yes</span>
                                        @else
                                            <span class="badge bg-secondary">No</span>
                                        @endif
                                    </td>
                                    <td>
                                        @foreach($category->attributes as $attr)
                                            <span class="badge bg-info text-dark">{{ $attr->name }}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="{{ route('backend.categories.edit', $category->id) }}" class="btn btn-sm btn-primary">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('backend.categories.destroy', $category->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            @if($categories->isEmpty())
                                <tr>
                                    <td colspan="6" class="text-center">No categories found.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
