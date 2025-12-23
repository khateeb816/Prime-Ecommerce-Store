<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index($category = null)
    {
        return view('frontend.products.index', compact('category'));
    }

    public function brand($brand)
    {
        // Decode brand name from slug
        $brandName = str_replace('-', ' ', $brand);
        $brandName = ucwords($brandName);

        // For now, we'll use sample data structure
        // In production, you'd query: Product::where('brand', 'like', "%{$brandName}%")->get()

        // Sample products for the brand (Most Searched - sorted by views/searches)
        $mostSearchedProducts = [
            ['name' => $brandName . ' Model X1', 'price' => 45000, 'old_price' => 55000, 'discount' => 18, 'rating' => 4.5, 'reviews' => 120, 'slug' => strtolower(str_replace(' ', '-', $brandName . '-model-x1'))],
            ['name' => $brandName . ' Model X2', 'price' => 52000, 'old_price' => 65000, 'discount' => 20, 'rating' => 4.7, 'reviews' => 95, 'slug' => strtolower(str_replace(' ', '-', $brandName . '-model-x2'))],
            ['name' => $brandName . ' Model X3', 'price' => 38000, 'old_price' => null, 'discount' => null, 'rating' => 4.3, 'reviews' => 78, 'slug' => strtolower(str_replace(' ', '-', $brandName . '-model-x3'))],
            ['name' => $brandName . ' Model X4', 'price' => 48000, 'old_price' => 60000, 'discount' => 20, 'rating' => 4.6, 'reviews' => 150, 'slug' => strtolower(str_replace(' ', '-', $brandName . '-model-x4'))],
        ];

        // Sample products for the brand (Latest - sorted by created_at)
        $latestProducts = [
            ['name' => $brandName . ' Latest Model 2024', 'price' => 55000, 'old_price' => 70000, 'discount' => 21, 'rating' => 4.8, 'reviews' => 45, 'slug' => strtolower(str_replace(' ', '-', $brandName . '-latest-model-2024'))],
            ['name' => $brandName . ' New Edition', 'price' => 42000, 'old_price' => null, 'discount' => null, 'rating' => 4.4, 'reviews' => 32, 'slug' => strtolower(str_replace(' ', '-', $brandName . '-new-edition'))],
            ['name' => $brandName . ' Premium Series', 'price' => 68000, 'old_price' => 85000, 'discount' => 20, 'rating' => 4.9, 'reviews' => 67, 'slug' => strtolower(str_replace(' ', '-', $brandName . '-premium-series'))],
            ['name' => $brandName . ' Compact Model', 'price' => 35000, 'old_price' => 45000, 'discount' => 22, 'rating' => 4.2, 'reviews' => 89, 'slug' => strtolower(str_replace(' ', '-', $brandName . '-compact-model'))],
        ];

        return view('frontend.products.brand', compact('brandName', 'mostSearchedProducts', 'latestProducts'));
    }

    public function show($slug)
    {
        // Decode product name from slug
        $productName = str_replace('-', ' ', $slug);
        $productName = ucwords($productName);

        // Sample product data
        // In production, you'd query: Product::where('slug', $slug)->firstOrFail()
        $product = [
            'name' => $productName,
            'price' => 45000,
            'old_price' => 55000,
            'discount' => 18,
            'rating' => 4.5,
            'reviews' => 120,
            'description' => 'This is a high-quality product with excellent features. It comes with a warranty and all necessary accessories. Perfect for your needs.',
            'specifications' => [
                'Brand' => 'Prime',
                'Model' => '2024 Edition',
                'Warranty' => '1 Year',
                'Color' => 'White',
                'Dimensions' => '50 x 30 x 20 cm',
                'Weight' => '5 kg'
            ],
            'images' => ['product1.jpg', 'product2.jpg', 'product3.jpg']
        ];

        return view('frontend.products.show', compact('product', 'slug'));
    }

    public function search(Request $request)
    {
        $query = $request->get('q');
        return view('frontend.products.search', compact('query'));
    }
}

