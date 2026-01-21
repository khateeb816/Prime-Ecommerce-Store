<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        $query = Review::with(['user', 'product']);

        if ($request->filled('homepage')) {
            $query->where('show_on_homepage', $request->homepage == 'yes' ? 1 : 0);
        }

        $reviews = $query->latest()->paginate(20)->withQueryString();
        
        return view('backend.reviews.index', compact('reviews'));
    }

    public function edit(Review $review)
    {
        return view('backend.reviews.edit', compact('review'));
    }

    public function update(Request $request, Review $review)
    {
        $request->validate([
            'reply' => 'nullable|string',
            // show_on_homepage is handled via checkbox usually
        ]);

        $review->update([
            'reply' => $request->reply,
            'show_on_homepage' => $request->has('show_on_homepage'),
        ]);

        return redirect()->route('backend.reviews.index')->with('success', 'Review updated successfully');
    }

    public function destroy(Review $review)
    {
        $review->delete();
        return redirect()->route('backend.reviews.index')->with('success', 'Review deleted successfully');
    }
}
