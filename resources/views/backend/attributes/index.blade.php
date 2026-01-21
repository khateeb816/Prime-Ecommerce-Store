@extends('backend.layouts.app')

@section('title', 'Attributes | Prime Admin')
@section('page-title', 'Attributes')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="white-box p-4 bg-white rounded shadow-sm">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="box-title mb-0">All Attributes</h3>
                    <a href="{{ route('backend.attributes.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-2"></i>Add New Attribute
                    </a>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Slug</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($attributes as $attribute)
                                <tr>
                                    <td>{{ $attribute->id }}</td>
                                    <td><strong>{{ $attribute->name }}</strong></td>
                                    <td><span class="badge bg-info">{{ $attribute->type }}</span></td>
                                    <td>{{ $attribute->slug }}</td>
                                    <td>
                                        <a href="{{ route('backend.attributes.edit', $attribute->id) }}" class="btn btn-sm btn-primary">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('backend.attributes.destroy', $attribute->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            @if($attributes->isEmpty())
                                <tr>
                                    <td colspan="5" class="text-center">No attributes found.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
