@extends('backend.layouts.app')

@section('title', 'Edit Product | Prime Admin')
@section('page-title', 'Edit Product')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="white-box">
                <form method="POST" action="{{ route('backend.products.update', $id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label class="form-label">Product Name *</label>
                                <input type="text" class="form-control" name="name" value="Product Name {{ $id }}" required>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" name="description" rows="5">Product description here...</textarea>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Price *</label>
                                        <input type="number" class="form-control" name="price" value="65000" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Old Price</label>
                                        <input type="number" class="form-control" name="old_price" value="85000">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Category *</label>
                                        <select class="form-select" name="category_id" required>
                                            <option value="1" selected>Air Conditioner</option>
                                            <option value="2">Refrigerator</option>
                                            <option value="3">LED TV</option>
                                            <option value="4">Washing Machine</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Brand</label>
                                        <input type="text" class="form-control" name="brand" value="Haier">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Stock Quantity *</label>
                                        <input type="number" class="form-control" name="stock" value="50" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">SKU</label>
                                        <input type="text" class="form-control" name="sku" value="PRD-{{ str_pad($id, 4, '0', STR_PAD_LEFT) }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Product Image</label>
                                <input type="file" class="form-control" name="image" accept="image/*">
                                <small class="text-muted">Current image will be replaced</small>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select class="form-select" name="status">
                                    <option value="active" selected>Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="featured" id="featured" checked>
                                    <label class="form-check-label" for="featured">
                                        Featured Product
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Update Product</button>
                        <a href="{{ route('backend.products.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

