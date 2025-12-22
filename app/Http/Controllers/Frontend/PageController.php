<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function about()
    {
        return view('frontend.pages.about');
    }

    public function storeLocation()
    {
        return view('frontend.pages.store-location');
    }

    public function electronics($category = null)
    {
        return view('frontend.products.index', compact('category'));
    }
    public function mobiles($category = null)
    {
        return view('frontend.products.index', compact('category'));
    }
    public function bikes($category = null)
    {
        return view('frontend.products.index', compact('category'));
    }
}

