@props(['name', 'icon'])

<div class="col-6 col-md-3 col-lg-2">
    <div class="cat-item bg-white p-3 rounded shadow-sm h-100">
        <i class="bi {{ $icon }} cat-icon"></i>
        <p>{{ $name }}</p>
    </div>
</div>

