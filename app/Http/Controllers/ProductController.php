<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index($category = null)
    {
        return view('products.index', compact('category'));
    }

    public function show($slug)
    {
        return view('products.show', compact('slug'));
    }

    public function search(Request $request)
    {
        $query = $request->get('q');
        return view('products.search', compact('query'));
    }
}

