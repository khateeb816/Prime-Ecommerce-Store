@props(['name', 'icon', 'link' => null])

<div class="col-6 col-md-3 col-lg-2">
    <a href="{{ $link ?? route('products.category', str_replace(' ', '-', $name)) }}" class="text-decoration-none text-dark">
        <div class="cat-item bg-white p-3 rounded shadow-sm h-100">
            <i class="bi {{ $icon }} cat-icon"></i>
            <p>{{ $name }}</p>
        </div>
    </a>
</div>

