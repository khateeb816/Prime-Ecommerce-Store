@extends('backend.layouts.app')

@section('title', 'Brands | Prime Admin')
@section('page-title', 'Brands')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="white-box p-4 bg-white rounded shadow-sm">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="box-title mb-0">All Brands</h3>
                    <a href="{{ route('backend.brands.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-2"></i>Add New Brand
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
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($brands as $brand)
                                <tr>
                                    <td>{{ $brand->id }}</td>
                                    <td>
                                        @if($brand->icon)
                                            <img src="{{ asset('storage/' . $brand->icon) }}" alt="" width="30">
                                        @else
                                            <span class="text-muted">No Icon</span>
                                        @endif
                                    </td>
                                    <td><strong>{{ $brand->name }}</strong></td>
                                    <td>
                                        @if($brand->show_on_homepage)
                                            <span class="badge bg-success">Yes</span>
                                        @else
                                            <span class="badge bg-secondary">No</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('backend.brands.edit', $brand->id) }}" class="btn btn-sm btn-primary">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('backend.brands.destroy', $brand->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            @if($brands->isEmpty())
                                <tr>
                                    <td colspan="5" class="text-center">No brands found.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
