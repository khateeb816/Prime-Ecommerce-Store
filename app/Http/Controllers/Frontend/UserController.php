<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();
        
        $totalOrders = $user->orders()->count();
        $wishlistCount = $user->wishlist()->count();
        $reviewsCount = $user->reviews()->count();
        
        $recentOrders = $user->orders()->latest()->take(5)->get();

        return view('frontend.user.dashboard', compact('totalOrders', 'wishlistCount', 'reviewsCount', 'recentOrders'));
    }

    public function profile()
    {
        return view('frontend.user.profile');
    }

    public function orders()
    {
        $orders = auth()->user()->orders()->latest()->paginate(5);
        return view('frontend.user.orders', compact('orders'));
    }

    public function orderShow($id)
    {
        $order = auth()->user()->orders()->with('items.product')->findOrFail($id);
        
        if (request()->ajax()) {
            return view('frontend.user.partials.order_details_content', compact('order'))->render();
        }

        return view('frontend.user.order_show', compact('order'));
    }

    public function wishlist()
    {
        $wishlistItems = auth()->user()->wishlist()->with('product')->latest()->paginate(12);
        return view('frontend.user.wishlist', compact('wishlistItems'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'birthday' => 'nullable|date',
        ]);

        $user->update($data);

        return back()->with('success', 'Profile updated successfully.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|current_password',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = auth()->user();
        $user->update([
            'password' => \Illuminate\Support\Facades\Hash::make($request->password),
        ]);

        return back()->with('success', 'Password updated successfully.');
    }
}

