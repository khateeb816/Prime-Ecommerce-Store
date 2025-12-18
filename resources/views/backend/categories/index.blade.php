@extends('backend.layouts.app')

@section('title', 'Categories | Prime Admin')
@section('page-title', 'Categories')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="white-box">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="box-title">All Categories</h3>
                    <a href="{{ route('backend.categories.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-2"></i>Add New Category
                    </a>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Products</th>
                                <th>Status</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $categories = ['Air Conditioner', 'Geyser', 'Refrigerator', 'Deep Freezer', 'Water Dispenser', 'LED TV', 'Washing Machine', 'Heater', 'Air Fryer', 'Air Cooler', 'Personal Care', 'Kitchen Appliances', 'Iron & Garment Steamer', 'Microwave Oven', 'Oven Toaster'];
                            @endphp
                            @foreach($categories as $index => $category)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td><strong>{{ $category }}</strong></td>
                                    <td>{{ rand(10, 100) }}</td>
                                    <td>
                                        <span class="badge bg-success">Active</span>
                                    </td>
                                    <td>{{ now()->subDays(rand(1, 30))->format('M d, Y') }}</td>
                                    <td>
                                        <a href="{{ route('backend.categories.edit', $index + 1) }}" class="btn btn-sm btn-primary">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <button class="btn btn-sm btn-danger" onclick="deleteCategory({{ $index + 1 }})">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    function deleteCategory(id) {
        if (confirm('Are you sure you want to delete this category?')) {
            // Handle deletion
            console.log('Deleting category:', id);
        }
    }
</script>
@endpush

