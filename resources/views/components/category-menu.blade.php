@php
$allCategories = \App\Models\Category::whereHas('products')->get();

$brandsByCategory = \DB::table('brand_category')
    ->join('brands', 'brand_category.brand_id', '=', 'brands.id')
    ->whereIn('brand_category.category_id', $allCategories->pluck('id'))
    ->select(
        'brands.id',
        'brands.name',
        'brands.slug',
        'brand_category.category_id'
    )
    ->get()
    ->groupBy('category_id');
@endphp


<div class="category-menu-container">
    <div class="category-sidebar">
        <div class="category-header">SHOP BY CATEGORY</div>
        <ul class="category-list">
            @foreach($allCategories as $category)
                <li class="category-item" data-category="{{ $category->slug }}">
                    <a href="{{ route('products.category', $category->slug) }}" class="category-link d-flex align-items-center">
                        <i class="bi {{ $category->icon ?: 'bi-grid' }} me-3 fs-5 text-brand-blue"></i>
                        <span class="flex-grow-1">{{ $category->name }}</span>
                        <i class="bi bi-chevron-right ms-2 small text-muted"></i>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

    <div class="brands-dropdown">
        @foreach($allCategories as $category)
            <div class="brands-menu" data-category="{{ $category->slug }}">
                <div class="brands-header">{{ strtoupper($category->name) }} BRANDS</div>
                <ul class="brands-list">
                    @if($brandsByCategory->has($category->id))
                        @foreach($brandsByCategory->get($category->id) as $brand)
                            <li>
                                <a href="{{ route('products.brand', ['brand' => $brand->slug, 'category' => $category->slug]) }}">
                                    {{ $brand->name }}
                                </a>
                            </li>
                        @endforeach
                    @else
                        <li class="text-muted small ps-3">No brands found</li>
                    @endif
                </ul>
            </div>
        @endforeach
    </div>
</div>

