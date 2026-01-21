@extends('backend.layouts.app')

@section('title', 'View Product | Prime Admin')
@section('page-title', 'Product Details')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="white-box p-4">
            <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
                <h3 class="box-title mb-0">Product #{{ $product->id }}</h3>
                <div>
                    <a href="{{ route('backend.products.index') }}" class="btn btn-outline-secondary me-2">
                        <i class="bi bi-arrow-left me-2"></i>Back to List
                    </a>
                    <a href="{{ route('backend.products.edit', $product->id) }}" class="btn btn-primary">
                        <i class="bi bi-pencil me-2"></i>Edit Product
                    </a>
                </div>
            </div>

            <div class="row">
                <!-- Product Images -->
                <div class="col-md-5">
                    <div class="main-image p-3 border rounded mb-3 text-center bg-light">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid" style="max-height: 400px; object-fit: contain;">
                        @else
                            <div class="py-5">
                                <i class="bi bi-image display-1 text-muted"></i>
                                <p class="text-muted mt-2">No main image</p>
                            </div>
                        @endif
                    </div>
                    
                    @if($product->images->count() > 0)
                        <div class="row g-2">
                            @foreach($product->images as $gallery)
                                <div class="col-3">
                                    <div class="border rounded p-1 bg-white">
                                        <img src="{{ asset('storage/' . $gallery->image_path) }}" alt="Gallery" class="img-fluid rounded" style="height: 60px; width: 100%; object-fit: contain;">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Product Details -->
                <div class="col-md-7">
                    <div class="ps-md-4">
                        <h2 class="fw-bold mb-3">{{ $product->name }}</h2>
                        
                        <div class="mb-4">
                            <span class="h3 text-primary fw-bold">Rs. {{ number_format($product->price) }}</span>
                            @if($product->old_price)
                                <span class="text-muted text-decoration-line-through ms-2">Rs. {{ number_format($product->old_price) }}</span>
                            @endif
                        </div>

                        <div class="row mb-4">
                            <div class="col-sm-6 mb-3">
                                <label class="text-muted small text-uppercase fw-bold d-block">Category</label>
                                <span class="fw-bold">{{ $product->category->name ?? 'N/A' }}</span>
                            </div>
                            <div class="col-sm-6 mb-3">
                                <label class="text-muted small text-uppercase fw-bold d-block">Brand</label>
                                <span class="fw-bold">{{ $product->brand->name ?? 'N/A' }}</span>
                            </div>
                            <div class="col-sm-6 mb-3">
                                <label class="text-muted small text-uppercase fw-bold d-block">Model</label>
                                <span class="fw-bold">{{ $product->model ?? 'N/A' }}</span>
                            </div>
                            <div class="col-sm-6 mb-3">
                                <label class="text-muted small text-uppercase fw-bold d-block">Stock Status</label>
                                <span class="badge {{ $product->stock_status == 'in_stock' ? 'bg-success' : 'bg-danger' }}">
                                    {{ $product->stock_status == 'in_stock' ? 'In Stock' : 'Out of Stock' }}
                                </span>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="text-muted small text-uppercase fw-bold d-block">Tags</label>
                            @if($product->is_featured)
                                <span class="badge bg-warning text-dark me-1">Featured Product</span>
                            @endif
                            @if($product->is_on_sale)
                                <span class="badge bg-danger">On Sale ({{ $product->discount_percent }}% Off)</span>
                            @endif
                            @if(!$product->is_featured && !$product->is_on_sale)
                                <span class="badge bg-secondary">Standard Listing</span>
                            @endif
                        </div>

                        <div class="mb-4">
                            <label class="text-muted small text-uppercase fw-bold d-block mb-2">Description</label>
                            <div class="p-3 bg-light rounded border">
                                {!! nl2br(e($product->description)) ?: '<span class="text-muted italic">No description provided.</span>' !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Attributes & Specifications -->
            <div class="row mt-5">
                <div class="col-md-6 mb-4">
                    <div class="border rounded">
                        <div class="bg-light p-3 border-bottom">
                            <h5 class="mb-0 fw-bold"><i class="bi bi-list-stars me-2"></i>Product Attributes</h5>
                        </div>
                        <div class="p-0">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr class="small text-muted text-uppercase">
                                        <th class="ps-3 border-0">Attribute</th>
                                        <th class="border-0">Value</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($product->attributeValues as $val)
                                        <tr>
                                            <td class="ps-3 text-muted">{{ $val->attribute->name }}</td>
                                            <td class="fw-bold">{{ $val->value }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2" class="text-center py-4 text-muted">No attributes assigned.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="border rounded">
                        <div class="bg-light p-3 border-bottom">
                            <h5 class="mb-0 fw-bold"><i class="bi bi-info-circle me-2"></i>Additional Specifications</h5>
                        </div>
                        <div class="p-3">
                            @if($product->specifications && is_array($product->specifications))
                                <div class="row">
                                    @foreach($product->specifications as $key => $value)
                                        <div class="col-6 mb-2">
                                            <span class="text-muted small d-block">{{ $key }}</span>
                                            <span class="fw-bold">{{ $value }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            @elseif($product->specifications)
                                <p>{{ $product->specifications }}</p>
                            @else
                                <p class="text-muted mb-0">No additional specifications provided.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
