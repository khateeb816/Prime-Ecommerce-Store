<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Review;
use App\Models\ReviewLike;
use App\Models\ReviewReply;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function toggleLike(Request $request, $id)
    {
        $review = Review::findOrFail($id);
        $user = Auth::user();

        $existingLike = ReviewLike::where('user_id', $user->id)
            ->where('review_id', $review->id)
            ->first();

        if ($existingLike) {
            $existingLike->delete();
            $liked = false;
        } else {
            ReviewLike::create([
                'user_id' => $user->id,
                'review_id' => $review->id,
            ]);
            $liked = true;
        }

        // Update cached like count on review
        $review->likes_count = $review->likes()->count();
        $review->save();

        if ($request->wantsJson()) {
            return response()->json([
                'liked' => $liked,
                'likes_count' => $review->likes_count,
            ]);
        }

        return redirect()->back();
    }

    public function storeReply(Request $request, $id)
    {
        $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        $review = Review::findOrFail($id);

        ReviewReply::create([
            'user_id' => Auth::id(),
            'review_id' => $review->id,
            'body' => $request->body,
        ]);

        return redirect()->back()->with('success', 'Reply posted successfully!');
    }
}
