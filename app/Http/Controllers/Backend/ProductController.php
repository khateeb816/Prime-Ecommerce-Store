<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return view('backend.products.index');
    }

    public function create()
    {
        return view('backend.products.create');
    }

    public function store(Request $request)
    {
        // Handle product creation
        return redirect()->route('backend.products.index')->with('success', 'Product created successfully');
    }

    public function show($id)
    {
        return view('backend.products.show', compact('id'));
    }

    public function edit($id)
    {
        return view('backend.products.edit', compact('id'));
    }

    public function update(Request $request, $id)
    {
        // Handle product update
        return redirect()->route('backend.products.index')->with('success', 'Product updated successfully');
    }

    public function destroy($id)
    {
        // Handle product deletion
        return redirect()->route('backend.products.index')->with('success', 'Product deleted successfully');
    }
}
