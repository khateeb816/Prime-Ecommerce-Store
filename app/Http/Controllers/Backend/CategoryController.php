<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return view('backend.categories.index');
    }

    public function create()
    {
        return view('backend.categories.create');
    }

    public function store(Request $request)
    {
        // Handle category creation
        return redirect()->route('backend.categories.index')->with('success', 'Category created successfully');
    }

    public function edit($id)
    {
        return view('backend.categories.edit', compact('id'));
    }

    public function update(Request $request, $id)
    {
        // Handle category update
        return redirect()->route('backend.categories.index')->with('success', 'Category updated successfully');
    }

    public function destroy($id)
    {
        // Handle category deletion
        return redirect()->route('backend.categories.index')->with('success', 'Category deleted successfully');
    }
}
