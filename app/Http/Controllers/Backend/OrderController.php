<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->get('status');
        return view('backend.orders.index', compact('status'));
    }

    public function show($id)
    {
        return view('backend.orders.show', compact('id'));
    }

    public function updateStatus(Request $request, $id)
    {
        // Handle order status update
        return redirect()->route('backend.orders.index')->with('success', 'Order status updated successfully');
    }
}
