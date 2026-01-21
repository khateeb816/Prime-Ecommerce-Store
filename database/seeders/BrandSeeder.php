<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;
use Illuminate\Support\Str;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $brands = [
            ['name' => 'Haier', 'icon' => 'bi-building'],
            ['name' => 'LG', 'icon' => 'bi-building'],
            ['name' => 'Samsung', 'icon' => 'bi-building'],
            ['name' => 'Dawlance', 'icon' => 'bi-building'],
            ['name' => 'Philips', 'icon' => 'bi-building'],
            ['name' => 'Panasonic', 'icon' => 'bi-building'],
            ['name' => 'Orient', 'icon' => 'bi-building'],
            ['name' => 'Gree', 'icon' => 'bi-building'],
            ['name' => 'Nasgas', 'icon' => 'bi-building'],
            ['name' => 'Beetro', 'icon' => 'bi-building'],
            ['name' => 'Singer', 'icon' => 'bi-building'],
            ['name' => 'Canon', 'icon' => 'bi-building'],
            ['name' => 'TCL', 'icon' => 'bi-building'],
            ['name' => 'Sony', 'icon' => 'bi-building'],
            ['name' => 'Remington', 'icon' => 'bi-building'],
            ['name' => 'Braun', 'icon' => 'bi-building'],
            ['name' => 'Eastcool', 'icon' => 'bi-building'],
            ['name' => 'Kenwood', 'icon' => 'bi-building'],
            ['name' => 'Bosch', 'icon' => 'bi-building'],
            ['name' => 'Hitachi', 'icon' => 'bi-building'],
        ];

        // Ensure categories exist before attaching
        $categories = \App\Models\Category::all();

        foreach ($brands as $brand) {
            $b = Brand::firstOrCreate(
                ['slug' => Str::slug($brand['name'])],
                [
                    'name' => $brand['name'],
                    'icon' => null, // Icons would typically be paths to images, using null for now or could use placeholder
                    'show_on_homepage' => true,
                ]
            );

             if ($categories->isNotEmpty()) {
                // Attach random categories to brand
                $b->categories()->sync($categories->random(rand(2, 5))->pluck('id'));
            }
        }
    }
}
