<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('frontend.checkout.index', compact('cart', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'city' => 'required|string',
            'paymentMethod' => 'required|string'
        ]);

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('home')->with('error', 'Cart is empty');
        }

        $totalAmount = 0;
        foreach ($cart as $item) {
            $totalAmount += $item['price'] * $item['quantity'];
        }

        try {
            DB::beginTransaction();

            $shippingAddress = $request->first_name . ' ' . $request->last_name . "\n" .
                              $request->address . "\n" .
                              $request->city . ', ' . $request->postal_code;

            $order = Order::create([
                'user_id' => Auth::id() ?? null, // Allow guest if needed, though models might require id
                'status' => 'pending',
                'payment_status' => 'unpaid',
                'payment_method' => $request->paymentMethod,
                'total_amount' => $totalAmount,
                'shipping_address' => $shippingAddress,
                'phone' => $request->phone,
            ]);

            foreach ($cart as $id => $details) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $id,
                    'quantity' => $details['quantity'],
                    'price' => $details['price'],
                ]);
            }

            DB::commit();

            session()->forget('cart');

            return redirect()->route('home')->with('success', 'Order placed successfully! Your Order ID is #' . $order->id);

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Something went wrong. Please try again. ' . $e->getMessage());
        }
    }
}

