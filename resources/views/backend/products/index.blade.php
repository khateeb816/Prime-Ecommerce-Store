@extends('backend.layouts.app')

@section('title', 'Products | Prime Admin')
@section('page-title', 'Products')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="white-box">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="box-title">All Products</h3>
                    <a href="{{ route('backend.products.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-2"></i>Add New Product
                    </a>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for($i = 1; $i <= 20; $i++)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>
                                        <div class="product-image-placeholder" style="width: 50px; height: 50px; background: #f0f0f0; border-radius: 4px; display: flex; align-items: center; justify-content: center;">
                                            <i class="bi bi-image"></i>
                                        </div>
                                    </td>
                                    <td>Product Name {{ $i }}</td>
                                    <td>Category {{ $i % 5 + 1 }}</td>
                                    <td>Rs. {{ number_format(50000 + ($i * 5000)) }}</td>
                                    <td>{{ 100 - ($i * 3) }}</td>
                                    <td>
                                        @if($i % 3 == 0)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-secondary">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('backend.products.show', $i) }}" class="btn btn-sm btn-info">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('backend.products.edit', $i) }}" class="btn btn-sm btn-primary">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <button class="btn btn-sm btn-danger" onclick="deleteProduct({{ $i }})">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    function deleteProduct(id) {
        if (confirm('Are you sure you want to delete this product?')) {
            // Handle deletion
            console.log('Deleting product:', id);
        }
    }
</script>
@endpush

