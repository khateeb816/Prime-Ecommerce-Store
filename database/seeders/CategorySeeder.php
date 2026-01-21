<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Attribute;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Mobiles' => ['Brand', 'RAM', 'Storage', 'Camera', 'Battery', 'Processor', 'Screen Size'],
            'Laptops' => ['Brand', 'RAM', 'Storage', 'Processor', 'Screen Size', 'Battery'],
            'Fashion' => ['Brand', 'Size', 'Color', 'Material'],
            'Air Conditioner' => ['Brand', 'Inverter', 'Capacity', 'Warranty'],
            'Geyser' => ['Brand', 'Capacity', 'Warranty'],
            'Refrigerator' => ['Brand', 'Capacity', 'Warranty'],
            'Deep Freezer' => ['Brand', 'Capacity', 'Warranty'],
            'Water Dispenser' => ['Brand', 'Warranty'],
            'LED TV' => ['Brand', 'Screen Size', 'Warranty'],
            'Washing Machine' => ['Brand', 'Capacity', 'Warranty'],
            'Heater' => ['Brand'],
            'Air Fryer' => ['Brand', 'Capacity'],
            'Air Cooler' => ['Brand', 'Capacity'],
            'Personal Care' => ['Brand', 'Warranty'],
            'Kitchen Appliances' => ['Brand', 'Warranty'],
            'Iron & Garment Steamer' => ['Brand', 'Warranty'],
            'Microwave Oven' => ['Brand', 'Capacity'],
            'Oven Toaster' => ['Brand', 'Capacity'],
        ];

        // Icons map (using bootstrap icons for now as placeholders or names)
        $icons = [
            'Air Conditioner' => 'bi-snow',
            'LED TV' => 'bi-tv',
            'Built In Ovens' => 'bi-thermometer-high',
            'Refrigerator' => 'bi-thermometer-snow',
            'Washing Machine' => 'bi-arrow-repeat',
            'Water Dispenser' => 'bi-droplet-fill',
            'Air Cooler' => 'bi-wind',
            'Air Fryer' => 'bi-lightning-fill',
            'Deep Freezer' => 'bi-snow',
            'Kitchen Hoods' => 'bi-fan',
            'Kitchen Hobs' => 'bi-fire',
            'Kitchen Appliances' => 'bi-app',
            'Mobiles' => 'bi-phone',
            'Laptops' => 'bi-laptop',
            'Fashion' => 'bi-bag',
        ];

        foreach ($categories as $catName => $attrs) {
            $category = Category::firstOrCreate(
                ['slug' => Str::slug($catName)],
                [
                    'name' => $catName,
                    'icon' => null, // Placeholder for actual image path
                    'description' => "Shop the best $catName at Prime.",
                    'show_on_homepage' => true,
                ]
            );

            // Attach Attributes
            // Note: 'Brand' acts as a standalone standard filter often, but if we treat it as attribute:
            // We need to fetch Attribute IDs.
            $attrIds = [];
            foreach ($attrs as $attrName) {
                // We don't necessarily need 'Brand' in attributes table if it's a relation on Product.
                // But Prompt says: "Mobiles -> [Brand, Price, RAM...]"
                // I'll skip Brand here if it's not in attributes table, but I added it in AttributeSeeder? No I didn't add Brand to AttributeSeeder because Brand is its own entity.
                // So I will filter out 'Brand' and 'Price' from this list as they are core fields.
                if (in_array($attrName, ['Brand', 'Price'])) continue;

                $attribute = Attribute::where('name', $attrName)->first();
                if ($attribute) {
                    $attrIds[] = $attribute->id;
                }
            }
            $category->attributes()->sync($attrIds);
        }
    }
}
