<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\User;
use App\Models\Review;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all();
        $brands = Brand::all();
        $users = User::all();

        if ($categories->isEmpty() || $brands->isEmpty()) {
            return;
        }

        foreach ($categories as $category) {
            // Create 5-10 products per category
            for ($i = 0; $i < rand(5, 10); $i++) {
                $brand = $brands->random();
                $price = rand(1000, 200000);
                $isOnSale = rand(0, 1) == 1;
                $discountPercent = $isOnSale ? rand(5, 30) : 0;
                $discountedPrice = $isOnSale ? $price - ($price * ($discountPercent / 100)) : null;

                $name = $brand->name . ' ' . $category->name . ' ' . Str::random(5);

                $product = Product::create([
                    'category_id' => $category->id,
                    'brand_id' => $brand->id,
                    'name' => $name,
                    'slug' => Str::slug($name . '-' . rand(1, 1000)), // Ensure unique
                    'description' => 'This is a high-quality ' . $category->name . ' from ' . $brand->name . '. Excellent features and durability.',
                    'price' => $price,
                    'old_price' => $isOnSale ? $price : null,
                    'discounted_price' => $discountedPrice,
                    'discount_percent' => $isOnSale ? $discountPercent : null,
                    'is_on_sale' => $isOnSale,
                    'is_featured' => rand(0, 1) == 1,
                    'stock_status' => 'in_stock',
                    'rating' => rand(3, 5),
                    'reviews_count' => rand(0, 20),
                    'image' => null, // Placeholder
                ]);

                // Create dummy reviews
                if ($users->isNotEmpty()) {
                    $user = $users->random();
                    Review::create([
                        'user_id' => $user->id,
                        'product_id' => $product->id,
                        'rating' => rand(4, 5),
                        'comment' => 'Great product! Highly recommended.',
                        'show_on_homepage' => rand(0, 1) == 1,
                    ]);
                }
            }
        }
    }
}
