<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Order;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('user')->latest();
        
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }
        
        $orders = $query->paginate(15);
        return view('backend.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with(['user', 'items.product'])->findOrFail($id);
        return view('backend.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled'
        ]);

        $order = Order::findOrFail($id);
        $order->status = $request->status;

        if ($request->status == 'delivered') {
            $order->payment_status = 'paid';
        }

        $order->save();

        return back()->with('success', 'Order status updated successfully');
    }
}
