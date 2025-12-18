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

    public function corporateSales()
    {
        return view('frontend.pages.corporate-sales');
    }

    public function builtInKitchen()
    {
        return view('frontend.pages.built-in-kitchen');
    }
}

