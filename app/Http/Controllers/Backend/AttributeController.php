<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AttributeController extends Controller
{
    public function index()
    {
        $attributes = Attribute::all();
        return view('backend.attributes.index', compact('attributes'));
    }

    public function create()
    {
        return view('backend.attributes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:text,select,boolean',
        ]);

        Attribute::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'type' => $request->type,
        ]);

        return redirect()->route('backend.attributes.index')->with('success', 'Attribute created successfully.');
    }

    public function edit(Attribute $attribute)
    {
        return view('backend.attributes.edit', compact('attribute'));
    }

    public function update(Request $request, Attribute $attribute)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:text,select,boolean',
        ]);

        $attribute->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'type' => $request->type,
        ]);

        return redirect()->route('backend.attributes.index')->with('success', 'Attribute updated successfully.');
    }

    public function destroy(Attribute $attribute)
    {
        $attribute->delete();
        return redirect()->route('backend.attributes.index')->with('success', 'Attribute deleted successfully.');
    }
}
