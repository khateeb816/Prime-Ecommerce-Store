<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Brand;
use App\Models\Category;

$slug = 'mobiles';
$c = Category::where('slug', $slug)->first();

if ($c) {
    echo "Category: {$c->name} (ID: {$c->id})\n";
    $brands = Brand::whereHas('products', function ($q) use ($c) {
        $q->where('category_id', $c->id);
    })->get();
    echo 'Brands: '.$brands->pluck('name')->implode(', ')."\n";
} else {
    echo "Category '$slug' not found.\n";
}
