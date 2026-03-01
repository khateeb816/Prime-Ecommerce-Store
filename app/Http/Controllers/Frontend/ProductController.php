<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductAttributeValue;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request, $categorySlug = null)
    {
        $query = Product::query();

        // Eager load relationships
        $query->with(['category', 'brand', 'images', 'reviews', 'attributeValues']);

        $category = null;

        // 1. Handle Category context
        if ($categorySlug) {
            $category = Category::where('slug', $categorySlug)->with('attributes')->firstOrFail();
            $query->where('category_id', $category->id);
        } elseif ($request->has('category')) {
            $catSlug = $request->query('category');
            $category = Category::where('slug', $catSlug)->with('attributes')->first();
            if ($category) {
                $query->where('category_id', $category->id);
            }
        }

        // 2. Handle Brand (single or multiple)
        if ($request->has('brand')) {
            $brandsParam = is_array($request->brand) ? $request->brand : explode(',', $request->brand);
            $brandIds = Brand::whereIn('slug', $brandsParam)->pluck('id');
            if ($brandIds->isNotEmpty()) {
                $query->whereIn('brand_id', $brandIds);
            }
        }

        // 3. Handle Price Range
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // 4. Handle Rating
        if ($request->filled('rating')) {
            $query->where('rating', '>=', $request->rating);
        }

        // 5. Handle Attributes Filters
        if ($request->has('attributes')) {
            foreach ($request->input('attributes', []) as $attrId => $values) {
                if (! empty($values)) {
                    $query->whereHas('attributeValues', function ($q) use ($attrId, $values) {
                        $q->where('attribute_id', $attrId);
                        if (is_array($values)) {
                            $q->whereIn('value', $values);
                        } else {
                            $q->where('value', $values);
                        }
                    });
                }
            }
        }

        // 6. Sorting
        $sort = $request->get('sort', 'newest');
        switch ($sort) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'rating':
                $query->orderBy('rating', 'desc');
                break;
            case 'most_searched':
                $query->orderBy('reviews_count', 'desc');
                break;
            default: // newest
                $query->latest();
                break;
        }

        $products = $query->paginate(12)->withQueryString();

        // Prepare Filters Data
        $attributes = collect();
        if ($category) {
            // Fetch attributes assigned to this category
            $attributes = $category->attributes()->get();

            // For each attribute, fetch only unique values that exist in products of THIS category
            foreach ($attributes as $attribute) {
                $attribute->unique_values = ProductAttributeValue::where('attribute_id', $attribute->id)
                    ->whereHas('product', function ($q) use ($category) {
                        $q->where('category_id', $category->id);
                    })
                    ->pluck('value')
                    ->unique()
                    ->sort()
                    ->values();
            }

            // Filter out attributes with no unique values
            $attributes = $attributes->filter(function ($attr) {
                return $attr->unique_values && $attr->unique_values->count() > 0;
            });
        }

        // Fetch brands
        if ($category) {
            $brands = Brand::whereHas('products', function ($q) use ($category) {
                $q->where('category_id', $category->id);
            })->orderBy('name')->get();
        } else {
            $brands = Brand::orderBy('name')->get();
        }

        return view('frontend.products.index', compact('products', 'category', 'attributes', 'brands'));
    }

    public function brand(Request $request, $brandSlug)
    {
        $brand = Brand::where('slug', $brandSlug)->firstOrFail();
        $query = Product::where('brand_id', $brand->id)->with(['category', 'images', 'reviews', 'attributeValues']);

        $category = null;

        // 1. Handle Optional Category Filter
        if ($request->filled('category')) {
            $catSlug = $request->category;
            $category = Category::where('slug', $catSlug)->with('attributes')->first();
            if ($category) {
                $query->where('category_id', $category->id);
            }
        }

        // 2. Handle Attributes Filters (if category selected)
        if ($request->has('attributes')) {
            foreach ($request->input('attributes', []) as $attrId => $values) {
                if (! empty($values)) {
                    $query->whereHas('attributeValues', function ($q) use ($attrId, $values) {
                        $q->where('attribute_id', $attrId);
                        if (is_array($values)) {
                            $q->whereIn('value', $values);
                        } else {
                            $q->where('value', $values);
                        }
                    });
                }
            }
        }

        // 3. Sorting
        $sort = $request->get('sort', 'most_searched');
        switch ($sort) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'rating':
                $query->orderBy('rating', 'desc');
                break;
            case 'newest':
                $query->latest();
                break;
            default: // most_searched
                $query->orderBy('reviews_count', 'desc');
                break;
        }

        $products = $query->paginate(12)->withQueryString();

        // 4. Prepare Sidebar Categories
        $categories = Category::whereHas('products', function ($q) use ($brand) {
            $q->where('brand_id', $brand->id);
        })->withCount(['products' => function ($q) use ($brand) {
            $q->where('brand_id', $brand->id);
        }])->get();

        // 5. Prepare Dynamic Filters (if category selected)
        $attributes = collect();
        if ($category) {
            $attributes = $category->attributes()->get();
            foreach ($attributes as $attribute) {
                $attribute->unique_values = ProductAttributeValue::where('attribute_id', $attribute->id)
                    ->whereHas('product', function ($q) use ($brand, $category) {
                        $q->where('brand_id', $brand->id)
                            ->where('category_id', $category->id);
                    })
                    ->pluck('value')
                    ->unique()
                    ->sort()
                    ->values();
            }

            // Filter out attributes with no unique values
            $attributes = $attributes->filter(function ($attr) {
                return $attr->unique_values && $attr->unique_values->count() > 0;
            });
        }

        return view('frontend.products.brand', compact('brand', 'products', 'categories', 'category', 'attributes'));
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)
            ->with([
                'category',
                'brand',
                'images',
                'reviews.user',
                'reviews.replies.user',
                'reviews.likes',
                'attributeValues.attribute',
            ])
            ->firstOrFail();

        // Related products?
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        return view('frontend.products.show', compact('product', 'relatedProducts'));
    }

    public function search(Request $request)
    {
        $queryStr = $request->get('q');

        if (empty($queryStr)) {
            return redirect()->back()->with('error', 'Please enter a search term');
        }

        $query = Product::query()->with(['category', 'brand', 'images', 'reviews', 'attributeValues']);

        $query->where(function ($q) use ($queryStr) {
            $q->where('name', 'like', "%{$queryStr}%")
                ->orWhere('description', 'like', "%{$queryStr}%")
                ->orWhereHas('brand', function ($bq) use ($queryStr) {
                    $bq->where('name', 'like', "%{$queryStr}%");
                });
        });

        // Advanced Filtering logic (reuse structure from index or abstracted service)
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }
        if ($request->filled('rating')) {
            $query->where('rating', '>=', $request->rating);
        }

        if ($request->filled('category')) {
            $cat = Category::where('slug', $request->category)->first();
            if ($cat) {
                $query->where('category_id', $cat->id);
            }
        }

        // Sorting
        $sort = $request->get('sort', 'newest');
        if ($sort == 'price_asc') {
            $query->orderBy('price', 'asc');
        } elseif ($sort == 'price_desc') {
            $query->orderBy('price', 'desc');
        } elseif ($sort == 'rating') {
            $query->orderBy('rating', 'desc');
        } else {
            $query->latest();
        }

        $products = $query->paginate(12)->withQueryString();
        $categories = Category::has('products')->get();
        $brands = Brand::has('products')->get();

        return view('frontend.products.search', compact('products', 'queryStr', 'categories', 'brands'));
    }

    public function storeReview(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:10',
        ]);

        $product = Product::findOrFail($id);

        \App\Models\Review::create([
            'user_id' => auth()->id(),
            'product_id' => $product->id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        // Update product average rating
        $avgRating = \App\Models\Review::where('product_id', $product->id)->avg('rating');
        $product->update(['rating' => round($avgRating, 1)]);

        return redirect()->back()->with('success', 'Thank you for your review!');
    }
}
