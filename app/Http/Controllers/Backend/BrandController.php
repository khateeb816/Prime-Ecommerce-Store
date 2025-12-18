<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        return view('backend.brands.index');
    }

    public function create()
    {
        return view('backend.brands.create');
    }

    public function store(Request $request)
    {
        // Handle brand creation
        return redirect()->route('backend.brands.index')->with('success', 'Brand created successfully');
    }

    public function edit($id)
    {
        return view('backend.brands.edit', compact('id'));
    }

    public function update(Request $request, $id)
    {
        // Handle brand update
        return redirect()->route('backend.brands.index')->with('success', 'Brand updated successfully');
    }

    public function destroy($id)
    {
        // Handle brand deletion
        return redirect()->route('backend.brands.index')->with('success', 'Brand deleted successfully');
    }
}

