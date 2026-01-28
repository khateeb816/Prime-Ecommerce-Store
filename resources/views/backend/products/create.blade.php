@extends('backend.layouts.app')

@section('title', 'Add Product | Prime Admin')
@section('page-title', 'Add Product')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="white-box p-4">
                <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
                    <h3 class="box-title mb-0">Create New Product</h3>
                    <a href="{{ route('backend.products.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Back to List
                    </a>
                </div>

                <form method="POST" action="{{ route('backend.products.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <!-- Left Column: Core Data -->
                        <div class="col-md-8">
                            <div class="card border-0 bg-light mb-4 text-dark">
                                <div class="card-body">
                                    <h5 class="fw-bold mb-3">Basic Information</h5>
                                    <div class="mb-3">
                                        <label class="form-label text-muted small text-uppercase fw-bold">Product Name
                                            *</label>
                                        <input type="text" class="form-control" name="name"
                                            value="{{ old('name') }}" required
                                            placeholder="e.g. Haier HSU-18HF 1.5 Ton DC Inverter">
                                    </div>

                                    <div class="mb-3">
                                        <label
                                            class="form-label text-muted small text-uppercase fw-bold">Description</label>
                                        <textarea class="form-control" name="description" rows="5" placeholder="Detailed product features...">{{ old('description') }}</textarea>
                                    </div>

                                    <div class="row g-3">
                                        <div class="col-md-12">
                                            <label class="form-label text-muted small text-uppercase fw-bold">Category
                                                *</label>
                                            <select class="form-select" name="category_id" required
                                                onchange="fetchBrandsAndAttributes(this.value)">
                                                <option value="">Select Category</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card border-0 bg-light mb-4 text-dark">
                                <div class="card-body">
                                    <h5 class="fw-bold mb-3">Pricing & Inventory</h5>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label text-muted small text-uppercase fw-bold">Price (Rs.)
                                                *</label>
                                            <input type="number" class="form-control" name="price"
                                                value="{{ old('price') }}" required placeholder="0">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label text-muted small text-uppercase fw-bold">Old Price
                                                (Rs.)</label>
                                            <input type="number" class="form-control" name="old_price"
                                                value="{{ old('old_price') }}" placeholder="0">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label text-muted small text-uppercase fw-bold">Brand</label>
                                            <select class="form-select" name="brand_id" id='brands'>
                                                <option value="">Select Brand</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label text-muted small text-uppercase fw-bold">Stock
                                                Status</label>
                                            <select class="form-select" name="stock_status">
                                                <option value="in_stock"
                                                    {{ old('stock_status') == 'in_stock' ? 'selected' : '' }}>In Stock
                                                </option>
                                                <option value="out_of_stock"
                                                    {{ old('stock_status') == 'out_of_stock' ? 'selected' : '' }}>Out of
                                                    Stock</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card border-0 bg-light mb-4 text-dark">
                                <div class="card-body">
                                    <h5 class="fw-bold mb-3">Product Attributes</h5>
                                    <div class="row g-3 align-items-end mb-4">
                                        <div class="col-md-8">
                                            <label class="form-label text-muted small text-uppercase fw-bold">Select
                                                Attribute</label>
                                            <select class="form-select" id="attribute_selector">
                                                <option value="">Choose an attribute...</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <button type="button" class="btn btn-dark w-100" id="add_attribute_btn">
                                                <i class="bi bi-plus-lg me-1"></i> Add
                                            </button>
                                        </div>
                                    </div>
                                    <div id="attributes_list" class="bg-white border rounded p-3" style="min-height: 50px;">
                                        <p class="text-muted text-center mb-0" id="no_attr_msg">No attributes added yet.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column: Status & Images -->
                        <div class="col-md-4">
                            <div class="card border-0 bg-light mb-4 text-dark">
                                <div class="card-body">
                                    <h5 class="fw-bold mb-3">Main Image</h5>
                                    <input type="file" class="form-control" name="image" accept="image/*" required>
                                    <small class="text-muted d-block mt-1">This will be the primary product image.</small>
                                </div>
                            </div>

                            <div class="card border-0 bg-light mb-4 text-dark">
                                <div class="card-body">
                                    <h5 class="fw-bold mb-3">Gallery Images</h5>
                                    <input type="file" class="form-control" name="images[]" multiple accept="image/*">
                                    <small class="text-muted d-block mt-1">Upload multiple images for the gallery.</small>
                                </div>
                            </div>

                            <div class="card border-0 bg-light text-dark">
                                <div class="card-body">
                                    <h5 class="fw-bold mb-3">Visibility</h5>
                                    <div class="form-check form-switch mb-3">
                                        <input class="form-check-input" type="checkbox" name="is_featured"
                                            id="is_featured" {{ old('is_featured') ? 'checked' : '' }}>
                                        <label class="form-check-label fw-bold" for="is_featured">Featured Product</label>
                                    </div>
                                    <div class="form-check form-switch mb-3">
                                        <input class="form-check-input" type="checkbox" name="is_on_sale"
                                            id="is_on_sale" {{ old('is_on_sale') ? 'checked' : '' }}>
                                        <label class="form-check-label fw-bold" for="is_on_sale">Flash Sale /
                                            Discount</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 pt-3 border-top text-end">
                        <a href="{{ route('backend.products.index') }}"
                            class="btn btn-outline-secondary px-4 me-2">Cancel</a>
                        <button type="submit" class="btn btn-primary px-5">Save Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function fetchBrandsAndAttributes(categoryId) {
            if (!categoryId) {
                document.getElementById("brands").innerHTML =
                    `<option value="">Select Brand</option>`;
                return;
            }

            fetch(`/admin/brandsByCategory/${categoryId}`)
                .then(res => res.json())
                .then(brands => {
                    let brandSelect = document.getElementById("brands");
                    brandSelect.innerHTML = `<option value="">Select Brand</option>`;

                    brands.forEach(brand => {
                        let option = document.createElement("option");
                        option.value = brand.id;
                        option.textContent = brand.name;
                        brandSelect.appendChild(option);
                    });
                })
                .catch(err => console.error(err));

            fetch(`/admin/attributesByCategory/${categoryId}`)
                .then(res => res.json())
                .then(attributes => {
                    let attributeSelect = document.getElementById("attribute_selector");
                    attributeSelect.innerHTML = `<option value="">Select Attribute</option>`;

                    attributes.forEach(attribute => {
                        let option = document.createElement("option");
                        option.value = attribute.id;
                        option.textContent = attribute.name;
                        attributeSelect.appendChild(option);
                    });
                })
                .catch(err => console.error(err));
        }


        document.addEventListener('DOMContentLoaded', function() {
            const attributeSelector = document.getElementById('attribute_selector');
            const addAttributeBtn = document.getElementById('add_attribute_btn');
            const attributesList = document.getElementById('attributes_list');
            const noAttrMsg = document.getElementById('no_attr_msg');

            addAttributeBtn.addEventListener('click', function() {
                const attributeId = attributeSelector.value;

                if (!attributeId) {
                    alert('Please select an attribute first.');
                    return;
                }

                const selectedOption = attributeSelector.options[attributeSelector.selectedIndex];
                const attributeName = selectedOption.dataset.name || selectedOption.textContent;

                // Prevent duplicates
                if (document.querySelector(`.attribute-row[data-id="${attributeId}"]`)) {
                    alert('This attribute is already added.');
                    return;
                }

                if (noAttrMsg) noAttrMsg.style.display = 'none';

                const row = document.createElement('div');
                row.className =
                    'attribute-row mb-3 d-flex align-items-end gap-3 p-3 border rounded bg-light';
                row.dataset.id = attributeId;

                row.innerHTML = `
            <div class="flex-grow-1">
                <label class="form-label text-muted small text-uppercase fw-bold mb-1">
                    ${attributeName}
                </label>
                <input type="text"
                       class="form-control"
                       name="attribute_values[${attributeId}][]"
                       placeholder="Enter ${attributeName} value..."
                       required>
            </div>
            <button type="button" class="btn btn-outline-danger remove-attribute-btn">
                <i class="bi bi-trash"></i>
            </button>
        `;

                attributesList.appendChild(row);
                attributeSelector.value = '';
            });

            // Remove attribute row
            attributesList.addEventListener('click', function(e) {
                if (e.target.closest('.remove-attribute-btn')) {
                    e.target.closest('.attribute-row').remove();
                    if (attributesList.querySelectorAll('.attribute-row').length === 0) {
                        noAttrMsg.style.display = 'block';
                    }
                }
            });
        });
    </script>
@endpush
