<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Attribute;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('attributes')->get();
        return view('backend.categories.index', compact('categories'));
    }

    public function create()
    {
        $attributes = Attribute::all();
        return view('backend.categories.create', compact('attributes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'attributes' => 'array',
        ]);

        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'icon' => $request->icon,
            'description' => $request->description,
            'show_on_homepage' => $request->has('show_on_homepage'),
        ];

        $category = Category::create($data);

        if ($request->has('attributes')) {
            $category->attributes()->sync($request->input('attributes', []));
        }

        return redirect()->route('backend.categories.index')->with('success', 'Category created successfully');
    }

    public function edit(Category $category)
    {
        $attributes = Attribute::all();
        return view('backend.categories.edit', compact('category', 'attributes'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'attributes' => 'array',
        ]);

        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'icon' => $request->icon,
            'description' => $request->description,
            'show_on_homepage' => $request->has('show_on_homepage'),
        ];

        $category->update($data);

        if ($request->has('attributes')) {
            $category->attributes()->sync($request->input('attributes', []));
        }

        return redirect()->route('backend.categories.index')->with('success', 'Category updated successfully');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('backend.categories.index')->with('success', 'Category deleted successfully');
    }
}
