<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Attribute;
use App\Models\ProductAttributeValue;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['category', 'brand']);

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('brand')) {
            $query->where('brand_id', $request->brand);
        }

        if ($request->filled('on_sale')) {
            $query->where('is_on_sale', $request->on_sale == 'yes' ? 1 : 0);
        }

        if ($request->filled('featured')) {
            $query->where('is_featured', $request->featured == 'yes' ? 1 : 0);
        }

        if ($request->filled('q')) {
            $query->where('name', 'like', '%' . $request->q . '%');
        }

        $products = $query->latest()->paginate(20)->withQueryString();
        
        $categories = Category::all();
        $brands = Brand::all();
        $attributes = Attribute::all();

        return view('backend.products.index', compact('products', 'categories', 'brands', 'attributes'));
    }

    public function bulkUpdateAttributes(Request $request)
    {
        $request->validate([
            'product_ids' => 'required|array',
            'product_ids.*' => 'exists:products,id',
            'attribute_id' => 'required|exists:attributes,id',
            'attribute_value' => 'required|string|max:255',
        ]);

        foreach ($request->product_ids as $productId) {
            ProductAttributeValue::updateOrCreate(
                ['product_id' => $productId, 'attribute_id' => $request->attribute_id],
                ['value' => $request->attribute_value]
            );
        }

        return redirect()->back()->with('success', count($request->product_ids) . ' products updated successfully.');
    }

    public function create()
    {
        $categories = Category::with('attributes')->get();
        $brands = Brand::all();
        // We might need all attributes to be safe or rely on JS to show specific ones
        // But for filtering, we only care about attributes assigned to the category.
        // However, looking at the prompt: "Examples: Mobiles -> [Brand, Price, RAM...]"
        // Admin selects filters for category.
        // Product creation should probably key off of the category's attributes.
        $attributes = Attribute::all();
        return view('backend.products.create', compact('categories', 'brands', 'attributes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'price' => 'required|numeric',
            'image' => 'nullable|image|max:2048',
            'images.*' => 'nullable|image|max:2048',
        ]);

        $data = $request->only([
            'category_id', 'brand_id', 'name', 'description', 
            'price', 'old_price', 'discounted_price', 'discount_percent', 
            'stock_status', 'model'
        ]);
        
        $data['slug'] = Str::slug($request->name);
        $data['is_on_sale'] = $request->has('is_on_sale');
        $data['is_featured'] = $request->has('is_featured');
        
        if ($request->specifications) {
            // Assuming specifications is passed as array or JSON string. 
            // If it's a dynamic form repeater, it might come as array.
            $data['specifications'] = $request->specifications;
        }

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product = Product::create($data);

        // Handle Gallery Images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                 $path = $file->store('products', 'public');
                 $product->images()->create(['image_path' => $path]);
            }
        }

        // Handle Attributes
        if ($request->has('attribute_values')) {
            foreach ($request->attribute_values as $attrId => $values) {
                $values = (array) $values;
                foreach ($values as $value) {
                    if ($value) {
                        ProductAttributeValue::create([
                            'product_id' => $product->id,
                            'attribute_id' => $attrId,
                            'value' => $value,
                        ]);
                    }
                }
            }
        }

        return redirect()->route('backend.products.index')->with('success', 'Product created successfully');
    }

    public function show(Product $product)
    {
        $product->load(['category', 'brand', 'attributeValues.attribute', 'images']);
        return view('backend.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::with('attributes')->get();
        $brands = Brand::all();
        $product->load(['attributeValues', 'images']);
        $attributes = Attribute::all();
        return view('backend.products.edit', compact('product', 'categories', 'brands', 'attributes'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'price' => 'required|numeric',
        ]);

        $data = $request->only([
            'category_id', 'brand_id', 'name', 'description', 
            'price', 'old_price', 'discounted_price', 'discount_percent', 
            'stock_status', 'model'
        ]);
        
        $data['slug'] = Str::slug($request->name);
        $data['is_on_sale'] = $request->has('is_on_sale');
        $data['is_featured'] = $request->has('is_featured');
        
         if ($request->specifications) {
            $data['specifications'] = $request->specifications;
        }

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        // Handle Gallery Images (Append new ones)
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                 $path = $file->store('products', 'public');
                 $product->images()->create(['image_path' => $path]);
            }
        }
        
        // Handle Attribute Values
        ProductAttributeValue::where('product_id', $product->id)->delete();
        if ($request->has('attribute_values')) {
            foreach ($request->attribute_values as $attrId => $values) {
                $values = (array) $values;
                foreach ($values as $value) {
                    if ($value) {
                        ProductAttributeValue::create([
                            'product_id' => $product->id,
                            'attribute_id' => $attrId,
                            'value' => $value,
                        ]);
                    }
                }
            }
        }

        return redirect()->route('backend.products.index')->with('success', 'Product updated successfully');
    }

    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        // Delete gallery
        foreach($product->images as $img) {
            Storage::disk('public')->delete($img->image_path);
        }
        $product->delete();
        return redirect()->route('backend.products.index')->with('success', 'Product deleted successfully');
    }
}
