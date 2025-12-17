<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function about()
    {
        return view('pages.about');
    }

    public function storeLocation()
    {
        return view('pages.store-location');
    }

    public function corporateSales()
    {
        return view('pages.corporate-sales');
    }

    public function builtInKitchen()
    {
        return view('pages.built-in-kitchen');
    }
}

