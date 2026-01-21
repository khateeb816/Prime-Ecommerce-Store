<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Review;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::where('show_on_homepage', true)->take(10)->get();
        $brands = Brand::where('show_on_homepage', true)->get();
        $reviews = Review::where('show_on_homepage', true)->with('user', 'product')->get();
        
        // Maybe fetch some products for sections like "On Sale" or "Featured"
        $saleProducts = Product::where('is_on_sale', true)->take(8)->get();
        $featuredProducts = Product::where('is_featured', true)->take(8)->get();

        return view('frontend.home', compact('categories', 'brands', 'reviews', 'saleProducts', 'featuredProducts'));
    }
}
