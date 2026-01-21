<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Attribute;
use Illuminate\Support\Str;

class AttributeSeeder extends Seeder
{
    public function run(): void
    {
        $attributes = [
            ['name' => 'Color', 'type' => 'text'],
            ['name' => 'Size', 'type' => 'text'],
            ['name' => 'RAM', 'type' => 'text'],
            ['name' => 'Storage', 'type' => 'text'],
            ['name' => 'Battery', 'type' => 'text'],
            ['name' => 'Camera', 'type' => 'text'],
            ['name' => 'Processor', 'type' => 'text'],
            ['name' => 'Screen Size', 'type' => 'text'],
            ['name' => 'Warranty', 'type' => 'text'],
            ['name' => 'Material', 'type' => 'text'],
            ['name' => 'Inverter', 'type' => 'boolean'], // For ACs
            ['name' => 'Capacity', 'type' => 'text'], // For ACs/Fridges
        ];

        foreach ($attributes as $attr) {
            Attribute::firstOrCreate(
                ['slug' => Str::slug($attr['name'])],
                [
                    'name' => $attr['name'],
                    'type' => $attr['type'],
                ]
            );
        }
    }
}
