<?php

namespace App\Http\Controllers;

use App\Models\GameReview;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index($gameName)
    {
        $reviews = GameReview::where('game_name', $gameName)
            ->orderByDesc('created_at')
            ->get();

        $avgRating = GameReview::where('game_name', $gameName)
            ->avg('rating');

        $totalReviews = GameReview::where('game_name', $gameName)->count();

        return response()->json([
            'game_name' => $gameName,
            'reviews' => $reviews,
            'avg_rating' => $avgRating ? round($avgRating, 1) : null,
            'total_reviews' => $totalReviews,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'game_name' => ['required', 'string', 'max:100'],
            'player_name' => ['required', 'string', 'max:100'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'comment' => ['nullable', 'string', 'max:1000'],
        ]);

        $review = GameReview::create($validated);

        return response()->json($review, 201);
    }

    public function destroy($id)
    {
        $review = GameReview::findOrFail($id);
        $review->delete();

        return response()->json(['message' => 'Review deleted successfully']);
    }
}
