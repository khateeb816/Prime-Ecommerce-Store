@extends('backend.layouts.app')

@section('title', 'Edit Category | Prime Admin')
@section('page-title', 'Edit Category')

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="white-box p-4 bg-white rounded shadow-sm">
                <form method="POST" action="{{ route('backend.categories.update', $category->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label class="form-label">Category Name *</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name', $category->name) }}" required>
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label fw-bold">Select Category Icon</label>
                        <input type="hidden" name="icon" id="selected_icon" value="{{ old('icon', $category->icon ?: 'bi-grid') }}">
                        <div class="icon-picker-container border rounded p-3 bg-light" style="max-height: 250px; overflow-y: auto;">
                            <div class="row g-2" id="icon_grid">
                                @php
                                    $icons = [
                                        'bi-grid', 'bi-phone', 'bi-laptop', 'bi-tv', 'bi-watch', 'bi-headphones', 'bi-camera',
                                        'bi-controller', 'bi-keyboard', 'bi-mouse', 'bi-speaker', 'bi-printer', 'bi-display',
                                        'bi-cpu', 'bi-gpu', 'bi-memory', 'bi-plug', 'bi-battery-full', 'bi-wifi', 'bi-bluetooth',
                                        'bi-phone-landscape', 'bi-tablet', 'bi-smartwatch', 'bi-earbuds', 'bi-boombox', 'bi-cassette',
                                        'bi-disc', 'bi-projector', 'bi-router', 'bi-modem', 'bi-server', 'bi-calculator', 'bi-lightning-charge',
                                        'bi-bicycle', 'bi-car-front', 'bi-truck', 'bi-airplane', 'bi-ship', 'bi-train-front',
                                        'bi-house', 'bi-bag', 'bi-cart', 'bi-gift', 'bi-tag', 'bi-credit-card', 'bi-wallet',
                                        'bi-gem', 'bi-umbrella', 'bi-glasses', 'bi-watch', 'bi-backpack', 'bi-briefcase', 'bi-suit-heart'
                                    ];
                                    $currentIcon = old('icon', $category->icon ?: 'bi-grid');
                                @endphp
                                @foreach($icons as $icon)
                                    <div class="col-auto">
                                        <div class="icon-item p-2 border rounded bg-white text-center cursor-pointer {{ $icon == $currentIcon ? 'active border-primary bg-primary-light' : '' }}" 
                                             data-icon="{{ $icon }}" style="width: 45px; height: 45px; cursor: pointer; transition: all 0.2s;">
                                            <i class="bi {{ $icon }} fs-4"></i>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description" rows="4">{{ old('description', $category->description) }}</textarea>
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="show_on_homepage" name="show_on_homepage" {{ $category->show_on_homepage ? 'checked' : '' }}>
                        <label class="form-check-label" for="show_on_homepage">Show on Homepage</label>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Applicable Filters (Attributes)</label>
                        <div class="card card-body" style="max-height: 200px; overflow-y: auto;">
                            @foreach($attributes as $attribute)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="attributes[]" value="{{ $attribute->id }}" id="attr_{{ $attribute->id }}"
                                        {{ $category->attributes->contains($attribute->id) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="attr_{{ $attribute->id }}">
                                        {{ $attribute->name }}
                                    </label>
                                </div>
                            @endforeach
                            @if($attributes->isEmpty())
                                <p class="text-muted small">No attributes found. Please create attributes first.</p>
                            @endif
                        </div>
                    </div>
                    
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Update Category</button>
                        <a href="{{ route('backend.categories.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<style>
    .icon-item.active {
        border-color: #0d6efd !important;
        background-color: #e7f1ff !important;
        color: #0d6efd;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }
    .cursor-pointer { cursor: pointer; }
</style>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const iconGrid = document.getElementById('icon_grid');
    const selectedIconInput = document.getElementById('selected_icon');
    const iconItems = document.querySelectorAll('.icon-item');

    iconItems.forEach(item => {
        item.addEventListener('click', function() {
            // Remove active class from all
            iconItems.forEach(i => i.classList.remove('active', 'border-primary', 'bg-primary-light'));
            
            // Add active class to clicked
            this.classList.add('active');
            
            // Update hidden input
            selectedIconInput.value = this.dataset.icon;
        });
    });
});
</script>
@endpush
