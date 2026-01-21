<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::with('categories')->latest()->get();
        return view('backend.brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('backend.brands.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'categories' => 'required|array', // Enforce category selection
            'categories.*' => 'exists:categories,id',
        ]);

        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'show_on_homepage' => $request->has('show_on_homepage'),
        ];

        if ($request->hasFile('icon')) {
            $path = $request->file('icon')->store('brands', 'public');
            $data['icon'] = $path;
        }

        $brand = Brand::create($data);
        
        // Sync categories
        if ($request->has('categories')) {
            $brand->categories()->sync($request->categories);
        }

        return redirect()->route('backend.brands.index')->with('success', 'Brand created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $brand = Brand::findOrFail($id);
        $categories = Category::all();
        return view('backend.brands.edit', compact('brand', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $brand = Brand::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
             'categories' => 'nullable|array',
             'categories.*' => 'exists:categories,id',
        ]);

        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'show_on_homepage' => $request->has('show_on_homepage'),
        ];

        if ($request->hasFile('icon')) {
            // Delete old icon if exists
            if ($brand->icon) {
                Storage::disk('public')->delete($brand->icon);
            }
            $path = $request->file('icon')->store('brands', 'public');
            $data['icon'] = $path;
        }

        $brand->update($data);
        
        // Sync categories
        if ($request->has('categories')) {
             $brand->categories()->sync($request->categories);
        } else {
             $brand->categories()->detach();
        }


        return redirect()->route('backend.brands.index')->with('success', 'Brand updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = Brand::findOrFail($id);
        if ($brand->icon) {
            Storage::disk('public')->delete($brand->icon);
        }
        $brand->categories()->detach();
        $brand->delete();

        return redirect()->route('backend.brands.index')->with('success', 'Brand deleted successfully.');
    }
}
