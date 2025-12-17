@php
$categories = [
    'Air Conditioner' => ['Haier AC', 'Dawlance AC', 'LG AC', 'Samsung AC', 'Orient AC', 'Gree AC'],
    'Geyser' => ['Nasgas Geyser', 'Beetro Geyser', 'Super Asia Geyser', 'Canon Geyser', 'Singer Geyser'],
    'Refrigerator' => ['Haier Refrigerator', 'Dawlance Refrigerator', 'Eastcool Refrigerator', 'Kenwood Refrigerator', 'LG Refrigerator', 'Samsung Refrigerator', 'Bosch Refrigerator', 'Hitachi Refrigerator', 'Orient Refrigerator'],
    'Deep Freezer' => ['Haier Deep Freezer', 'Dawlance Deep Freezer', 'LG Deep Freezer'],
    'Water Dispenser' => ['Haier Water Dispenser', 'Dawlance Water Dispenser', 'LG Water Dispenser'],
    'LED TV' => ['Samsung TV', 'LG TV', 'TCL TV', 'Haier TV', 'Sony TV'],
    'Washing Machine' => ['Haier Washing Machine', 'Dawlance Washing Machine', 'LG Washing Machine', 'Samsung Washing Machine'],
    'Heater' => ['Haier Heater', 'Dawlance Heater', 'LG Heater'],
    'Air Fryer' => ['Haier Air Fryer', 'Dawlance Air Fryer', 'LG Air Fryer'],
    'Air Cooler' => ['Haier Air Cooler', 'Dawlance Air Cooler', 'Orient Air Cooler'],
    'Personal Care' => ['Philips Personal Care', 'Remington Personal Care', 'Braun Personal Care'],
    'Kitchen Appliances' => ['Haier Kitchen', 'Dawlance Kitchen', 'LG Kitchen'],
    'Iron & Garment Steamer' => ['Philips Iron', 'Panasonic Iron', 'Remington Iron'],
    'Microwave Oven' => ['Haier Microwave', 'LG Microwave', 'Samsung Microwave'],
    'Oven Toaster' => ['Haier Oven', 'LG Oven', 'Samsung Oven'],
];
@endphp

<div class="category-menu-container">
        <div class="category-sidebar">
            <div class="category-header">SHOP BY CATEGORY</div>
            <ul class="category-list">
                @foreach($categories as $category => $brands)
                    <li class="category-item" data-category="{{ $category }}">
                        <a href="#" class="category-link">
                            <span>{{ $category }}</span>
                            <i class="bi bi-chevron-right"></i>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="brands-dropdown">
            @foreach($categories as $category => $brands)
                <div class="brands-menu" data-category="{{ $category }}">
                    <div class="brands-header">{{ strtoupper($category) }} BRANDS</div>
                    <ul class="brands-list">
                        @foreach($brands as $brand)
                            <li><a href="#">{{ $brand }}</a></li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
    </div>
</div>

