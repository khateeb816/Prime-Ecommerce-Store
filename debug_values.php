<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Product;
use Illuminate\Support\Facades\DB;

$products = Product::where('category_id', 1)->get();
echo 'Products in Category 1: '.$products->count()."\n";

foreach ($products as $p) {
    echo "Product: {$p->name} (ID: {$p->id})\n";
    $values = DB::table('product_attribute_values')->where('product_id', $p->id)->get();
    foreach ($values as $v) {
        $attrName = DB::table('attributes')->where('id', $v->attribute_id)->value('name');
        echo "  - Attr ID: {$v->attribute_id} ($attrName), Value: {$v->value}\n";
    }
}

echo "\n--- Category 1 (Mobiles) assigned attributes ---\n";
$rels = DB::table('category_attribute')->where('category_id', 1)->get();
foreach ($rels as $rel) {
    $name = DB::table('attributes')->where('id', $rel->attribute_id)->value('name');
    echo "  - Attr ID: {$rel->attribute_id} ($name)\n";
}
