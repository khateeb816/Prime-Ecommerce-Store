<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Attribute;
use App\Models\ProductAttributeValue;
use App\Models\Category;

class ProductAttributeValueSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::with('attributes')->get();

        foreach ($categories as $category) {
            $products = $category->products;
            $attributes = $category->attributes;

            if ($products->isEmpty() || $attributes->isEmpty()) {
                continue;
            }

            foreach ($products as $product) {
                foreach ($attributes as $attribute) {
                    $value = $this->getRandomValueForAttribute($attribute->name);
                    if ($value) {
                        ProductAttributeValue::create([
                            'product_id' => $product->id,
                            'attribute_id' => $attribute->id,
                            'value' => $value,
                        ]);
                    }
                }
            }
        }
    }

    private function getRandomValueForAttribute($name)
    {
        $data = [
            'RAM' => ['4GB', '6GB', '8GB', '12GB', '16GB'],
            'Storage' => ['64GB', '128GB', '256GB', '512GB', '1TB'],
            'Color' => ['Black', 'White', 'Silver', 'Blue', 'Gold', 'Red'],
            'Size' => ['Small', 'Medium', 'Large', 'XL', 'XXL'],
            'Battery' => ['4000mAh', '4500mAh', '5000mAh', '6000mAh'],
            'Camera' => ['12MP', '48MP', '64MP', '108MP'],
            'Processor' => ['Snapdragon 8 Gen 1', 'Apple A15', 'Dimensity 9000', 'Core i5', 'Core i7', 'Ryzen 5', 'Ryzen 7'],
            'Screen Size' => ['6.1 inch', '6.5 inch', '6.7 inch', '13 inch', '14 inch', '15.6 inch', '32 inch', '43 inch', '55 inch'],
            'Warranty' => ['1 Year', '2 Years', '6 Months'],
            'Capacity' => ['1.0 Ton', '1.5 Ton', '2.0 Ton', '200L', '300L', '500L', '7kg', '8kg', '10kg'],
            'Material' => ['Cotton', 'Polyester', 'Leather', 'Aluminum', 'Plastic'],
            'Inverter' => ['Yes', 'No'],
        ];

        if (isset($data[$name])) {
            return $data[$name][array_rand($data[$name])];
        }

        return null;
    }
}
