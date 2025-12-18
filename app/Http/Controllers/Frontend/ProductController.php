<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index($category = null)
    {
        return view('frontend.products.index', compact('category'));
    }

    public function show($slug)
    {
        return view('frontend.products.show', compact('slug'));
    }

    public function search(Request $request)
    {
        $query = $request->get('q');
        return view('frontend.products.search', compact('query'));
    }
}

