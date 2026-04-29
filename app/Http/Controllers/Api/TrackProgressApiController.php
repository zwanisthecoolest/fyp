<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrackProgressApiController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $user = $request->user();
        if (!$user) {
            return response()->json([
                'data' => [],
            ], 401);
        }

        $validated = $request->validate([
            'game_name' => ['nullable', 'string', 'max:100'],
            'limit' => ['nullable', 'integer', 'min:1', 'max:200'],
        ]);

        $limit = $validated['limit'] ?? 100;

        $sessions = DB::table('reaction_sessions')
            ->where('user_id', $user->id)
            ->when(isset($validated['game_name']), function ($query) use ($validated) {
                $query->where('game_name', $validated['game_name']);
            })
            ->latest()
            ->limit($limit)
            ->get();

        return response()->json([
            'data' => $sessions,
        ]);
    }
}
