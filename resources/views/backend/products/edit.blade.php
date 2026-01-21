@extends('backend.layouts.app')

@section('title', 'Edit Product | Prime Admin')
@section('page-title', 'Edit Product')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="white-box p-4">
            <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
                <h3 class="box-title mb-0">Edit Product: {{ $product->name }}</h3>
                <a href="{{ route('backend.products.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-2"></i>Back to List
                </a>
            </div>

            <form method="POST" action="{{ route('backend.products.update', $product->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <!-- Left Column: Core Data -->
                    <div class="col-md-8">
                        <div class="card border-0 bg-light mb-4">
                            <div class="card-body">
                                <h5 class="fw-bold mb-3">Basic Information</h5>
                                <div class="mb-3">
                                    <label class="form-label text-muted small text-uppercase fw-bold">Product Name *</label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name', $product->name) }}" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label text-muted small text-uppercase fw-bold">Description</label>
                                    <textarea class="form-control" name="description" rows="5">{{ old('description', $product->description) }}</textarea>
                                </div>

                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label text-muted small text-uppercase fw-bold">Model / Serial</label>
                                        <input type="text" class="form-control" name="model" value="{{ old('model', $product->model) }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label text-muted small text-uppercase fw-bold">Category *</label>
                                        <select class="form-select" name="category_id" id="category_select" required>
                                            <option value="">Select Category</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card border-0 bg-light mb-4">
                            <div class="card-body">
                                <h5 class="fw-bold mb-3">Pricing & Inventory</h5>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label text-muted small text-uppercase fw-bold">Price (Rs.) *</label>
                                        <input type="number" class="form-control" name="price" value="{{ old('price', $product->price) }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label text-muted small text-uppercase fw-bold">Old Price (Rs.)</label>
                                        <input type="number" class="form-control" name="old_price" value="{{ old('old_price', $product->old_price) }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label text-muted small text-uppercase fw-bold">Brand</label>
                                        <select class="form-select" name="brand_id">
                                            <option value="">Select Brand</option>
                                            @foreach($brands as $brand)
                                                <option value="{{ $brand->id }}" {{ $product->brand_id == $brand->id ? 'selected' : '' }}>
                                                    {{ $brand->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label text-muted small text-uppercase fw-bold">Stock Status</label>
                                        <select class="form-select" name="stock_status">
                                            <option value="in_stock" {{ $product->stock_status == 'in_stock' ? 'selected' : '' }}>In Stock</option>
                                            <option value="out_of_stock" {{ $product->stock_status == 'out_of_stock' ? 'selected' : '' }}>Out of Stock</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card border-0 bg-light">
                            <div class="card-body">
                                <h5 class="fw-bold mb-3">Product Attributes</h5>
                                <div class="row g-3 align-items-end mb-4">
                                    <div class="col-md-8">
                                        <label class="form-label text-muted small text-uppercase fw-bold">Select Attribute</label>
                                        <select class="form-select" id="attribute_selector">
                                            <option value="">Choose an attribute...</option>
                                            @foreach($attributes as $attribute)
                                                <option value="{{ $attribute->id }}" data-name="{{ $attribute->name }}">{{ $attribute->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <button type="button" class="btn btn-dark w-100" id="add_attribute_btn">
                                            <i class="bi bi-plus-lg me-1"></i> Add
                                        </button>
                                    </div>
                                </div>
                                <div id="attributes_list" class="bg-white border rounded p-3" style="min-height: 50px;">
                                    @php
                                        $attrValues = $product->attributeValues->load('attribute');
                                    @endphp
                                    @forelse($attrValues as $val)
                                        <div class="attribute-row mb-3 d-flex align-items-end gap-3 p-3 border rounded bg-light" data-id="{{ $val->attribute_id }}">
                                            <div class="flex-grow-1">
                                                <label class="form-label text-muted small text-uppercase fw-bold mb-1">{{ $val->attribute->name }}</label>
                                                <input type="text" class="form-control" name="attribute_values[{{ $val->attribute_id }}][]" value="{{ $val->value }}" required>
                                            </div>
                                            <button type="button" class="btn btn-outline-danger remove-attribute-btn">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    @empty
                                        <p class="text-muted text-center mb-0" id="no_attr_msg">No attributes added yet.</p>
                                    @endforelse
                                    <p class="text-muted text-center mb-0" id="no_attr_msg" style="display: {{ $attrValues->count() > 0 ? 'none' : 'block' }}">No attributes added yet.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Right Column: Status & Images -->
                    <div class="col-md-4">
                        <div class="card border-0 bg-light mb-4">
                            <div class="card-body">
                                <h5 class="fw-bold mb-3">Main Image</h5>
                                @if($product->image)
                                    <div class="mb-3 text-center border p-2 bg-white rounded">
                                        <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded" style="max-height: 150px;">
                                    </div>
                                @endif
                                <input type="file" class="form-control" name="image" accept="image/*">
                                <small class="text-muted d-block mt-1">Upload to replace current image.</small>
                            </div>
                        </div>

                        <div class="card border-0 bg-light mb-4 text-dark">
                            <div class="card-body">
                                <h5 class="fw-bold mb-3">Gallery Images</h5>
                                <div class="row g-2 mb-3">
                                    @foreach($product->images as $img)
                                        <div class="col-4">
                                            <div class="border rounded p-1 bg-white position-relative">
                                                <img src="{{ asset('storage/' . $img->image_path) }}" class="img-fluid rounded">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <input type="file" class="form-control" name="images[]" multiple accept="image/*">
                                <small class="text-muted d-block mt-1">Add more images to the gallery.</small>
                            </div>
                        </div>

                        <div class="card border-0 bg-light">
                            <div class="card-body">
                                <h5 class="fw-bold mb-3">Visibility</h5>
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" name="is_featured" id="is_featured" {{ $product->is_featured ? 'checked' : '' }}>
                                    <label class="form-check-label fw-bold" for="is_featured">Featured Product</label>
                                </div>
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" name="is_on_sale" id="is_on_sale" {{ $product->is_on_sale ? 'checked' : '' }}>
                                    <label class="form-check-label fw-bold" for="is_on_sale">Flash Sale / Discount</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mt-4 pt-3 border-top text-end">
                    <a href="{{ route('backend.products.index') }}" class="btn btn-outline-secondary px-4 me-2">Cancel</a>
                    <button type="submit" class="btn btn-primary px-5">Save Product Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const attributeSelector = document.getElementById('attribute_selector');
    const addAttributeBtn = document.getElementById('add_attribute_btn');
    const attributesList = document.getElementById('attributes_list');
    const noAttrMsg = document.getElementById('no_attr_msg');

    addAttributeBtn.addEventListener('click', function() {
        const attributeId = attributeSelector.value;
        const attributeName = attributeSelector.options[attributeSelector.selectedIndex].dataset.name;

        if (!attributeId) {
            alert('Please select an attribute first.');
            return;
        }

        if (noAttrMsg) noAttrMsg.style.display = 'none';

        const row = document.createElement('div');
        row.className = 'attribute-row mb-3 d-flex align-items-end gap-3 p-3 border rounded bg-light';
        row.dataset.id = attributeId;
        row.innerHTML = `
            <div class="flex-grow-1">
                <label class="form-label text-muted small text-uppercase fw-bold mb-1">${attributeName}</label>
                <input type="text" class="form-control" name="attribute_values[${attributeId}][]" placeholder="Enter ${attributeName} value..." required>
            </div>
            <button type="button" class="btn btn-outline-danger remove-attribute-btn">
                <i class="bi bi-trash"></i>
            </button>
        `;

        attributesList.appendChild(row);
        attributeSelector.value = '';
    });

    attributesList.addEventListener('click', function(e) {
        if (e.target.closest('.remove-attribute-btn')) {
            e.target.closest('.attribute-row').remove();
            if (attributesList.querySelectorAll('.attribute-row').length === 0) {
                if (noAttrMsg) noAttrMsg.style.display = 'block';
            }
        }
    });
});
</script>
@endpush
