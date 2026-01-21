@extends('backend.layouts.app')

@section('title', 'Products | Prime Admin')
@section('page-title', 'Products')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="white-box">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="box-title">All Products</h3>
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-dark" id="toggleBulkBtn" style="display:none;">
                            <i class="bi bi-layers-fill me-2"></i>Bulk Update Attributes
                        </button>
                        <a href="{{ route('backend.products.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle me-2"></i>Add New Product
                        </a>
                    </div>
                </div>

                <!-- Admin Filters -->
                <div class="card bg-light border-0 mb-4">
                    <div class="card-body py-3">
                        <form action="{{ route('backend.products.index') }}" method="GET" class="row g-3 align-items-center">
                            <div class="col-md-3">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text bg-white border-end-0"><i class="bi bi-search"></i></span>
                                    <input type="text" name="q" class="form-control border-start-0" placeholder="Search products..." value="{{ request('q') }}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <select name="category" class="form-select form-select-sm" onchange="this.form.submit()">
                                    <option value="">All Categories</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select name="brand" class="form-select form-select-sm" onchange="this.form.submit()">
                                    <option value="">All Brands</option>
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->id }}" {{ request('brand') == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select name="on_sale" class="form-select form-select-sm" onchange="this.form.submit()">
                                    <option value="">Sale Status</option>
                                    <option value="yes" {{ request('on_sale') == 'yes' ? 'selected' : '' }}>On Sale Only</option>
                                    <option value="no" {{ request('on_sale') == 'no' ? 'selected' : '' }}>Not on Sale</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select name="featured" class="form-select form-select-sm" onchange="this.form.submit()">
                                    <option value="">Featured</option>
                                    <option value="yes" {{ request('featured') == 'yes' ? 'selected' : '' }}>Featured Only</option>
                                    <option value="no" {{ request('featured') == 'no' ? 'selected' : '' }}>Regular Only</option>
                                </select>
                            </div>
                            <div class="col-md-1">
                                <a href="{{ route('backend.products.index') }}" class="btn btn-outline-secondary btn-sm w-100" title="Reset Filters">
                                    <i class="bi bi-arrow-counterclockwise"></i>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Bulk Update Card (Hidden initially) -->
                <div class="card bg-light border-0 mb-4" id="bulkUpdateCard" style="display:none;">
                    <div class="card-body">
                        <form action="{{ route('backend.products.bulkUpdateAttributes') }}" method="POST" id="bulkUpdateForm">
                            @csrf
                            <div id="selected_ids_container"></div>
                            <div class="row align-items-end g-3">
                                <div class="col-md-4">
                                    <label class="form-label small fw-bold">Select Attribute</label>
                                    <select name="attribute_id" class="form-select" required>
                                        <option value="">Choose Attribute...</option>
                                        @foreach($attributes as $attribute)
                                            <option value="{{ $attribute->id }}">{{ $attribute->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-5">
                                    <label class="form-label small fw-bold">Attribute Value (e.g. 8GB, 128GB, Blue)</label>
                                    <input type="text" name="attribute_value" class="form-control" required placeholder="Enter value for selected products">
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-dark w-100">Apply to Selected</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle">
                        <thead>
                            <tr>
                                <th width="40">
                                    <input type="checkbox" class="form-check-input" id="selectAll">
                                </th>
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
                            @foreach($products as $product)
                                <tr>
                                    <td>
                                        <input type="checkbox" class="form-check-input product-checkbox" value="{{ $product->id }}">
                                    </td>
                                    <td>{{ $product->id }}</td>
                                    <td>
                                        @if($product->image)
                                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="width: 50px; height: 50px; object-fit: contain; border-radius: 4px; border: 1px solid #eee;">
                                        @else
                                            <div class="product-image-placeholder" style="width: 50px; height: 50px; background: #f0f0f0; border-radius: 4px; display: flex; align-items: center; justify-content: center;">
                                                <i class="bi bi-image text-muted"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="fw-bold">{{ $product->name }}</div>
                                        <small class="text-muted">{{ $product->model }}</small>
                                    </td>
                                    <td>{{ $product->category->name ?? 'N/A' }}</td>
                                    <td>Rs. {{ number_format($product->price) }}</td>
                                    <td>
                                        @if($product->stock_status == 'in_stock')
                                            <span class="badge bg-success-light text-success border border-success-subtle">In Stock</span>
                                        @else
                                            <span class="badge bg-danger-light text-danger border border-danger-subtle">Out of Stock</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($product->is_featured)
                                            <span class="badge bg-warning text-dark border border-warning-subtle">Featured</span>
                                        @endif
                                        <span class="badge {{ $product->is_on_sale ? 'bg-success' : 'bg-primary' }}">
                                            {{ $product->is_on_sale ? 'On Sale' : 'Active' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <a href="{{ route('products.show', $product->slug) }}" target="_blank" class="btn btn-sm btn-info text-white" title="View on Site">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('backend.products.edit', $product->id) }}" class="btn btn-sm btn-primary" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('backend.products.destroy', $product->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this product?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-4 d-flex justify-content-between align-items-center">
                    <div class="text-muted small">
                        Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} of {{ $products->total() }} products
                    </div>
                    <div>
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<style>
    .bg-success-light { background-color: #e8f5e9; }
    .bg-danger-light { background-color: #ffebee; }
    .cursor-pointer { cursor: pointer; }
</style>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const selectAll = document.getElementById('selectAll');
    const checkboxes = document.querySelectorAll('.product-checkbox');
    const toggleBulkBtn = document.getElementById('toggleBulkBtn');
    const bulkUpdateCard = document.getElementById('bulkUpdateCard');
    const bulkUpdateForm = document.getElementById('bulkUpdateForm');
    const selectedIdsContainer = document.getElementById('selected_ids_container');

    function updateBulkButton() {
        const checkedCount = document.querySelectorAll('.product-checkbox:checked').length;
        toggleBulkBtn.style.display = checkedCount > 0 ? 'block' : 'none';
        
        // Update button text to show count
        if (checkedCount > 0) {
            toggleBulkBtn.innerHTML = `<i class="bi bi-layers-fill me-2"></i>Bulk Update (${checkedCount})`;
        }
        
        if (checkedCount === 0) {
            bulkUpdateCard.style.display = 'none';
        }
    }

    selectAll.addEventListener('change', function() {
        checkboxes.forEach(cb => cb.checked = this.checked);
        updateBulkButton();
    });

    checkboxes.forEach(cb => {
        cb.addEventListener('change', updateBulkButton);
    });

    toggleBulkBtn.addEventListener('click', function() {
        bulkUpdateCard.style.display = bulkUpdateCard.style.display === 'none' ? 'block' : 'none';
        if (bulkUpdateCard.style.display === 'block') {
            bulkUpdateCard.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    });

    bulkUpdateForm.onsubmit = function() {
        const checked = document.querySelectorAll('.product-checkbox:checked');
        const ids = Array.from(checked).map(cb => cb.value);
        
        if (ids.length === 0) {
            alert('Please select at least one product.');
            return false;
        }

        selectedIdsContainer.innerHTML = '';
        ids.forEach(id => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'product_ids[]';
            input.value = id;
            selectedIdsContainer.appendChild(input);
        });

        return confirm(`Are you sure you want to update ${ids.length} products? This cannot be undone.`);
    };
});
</script>
@endpush
