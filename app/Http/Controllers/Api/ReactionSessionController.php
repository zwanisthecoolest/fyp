<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ReactionSession;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ReactionSessionController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'game_name' => ['nullable', 'string', 'max:100'],
            'user_id' => ['nullable', 'integer', 'exists:users,id'],
            'player_name' => ['nullable', 'string', 'max:100'],
            'source_player_id' => ['nullable', 'string', 'max:50'],
            'limit' => ['nullable', 'integer', 'min:1', 'max:200'],
        ]);

        $limit = $validated['limit'] ?? 50;

        $sessions = ReactionSession::query()
            ->when(isset($validated['game_name']), function ($query) use ($validated) {
                $query->where('game_name', $validated['game_name']);
            })
            ->when(isset($validated['user_id']), function ($query) use ($validated) {
                $query->where('user_id', $validated['user_id']);
            })
            ->when(isset($validated['player_name']), function ($query) use ($validated) {
                $query->where('player_name', $validated['player_name']);
            })
            ->when(isset($validated['source_player_id']), function ($query) use ($validated) {
                $query->where('meta->source_player_id', $validated['source_player_id']);
            })
            ->latest()
            ->limit($limit)
            ->get();

        return response()->json([
            'data' => $sessions,
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'game_name' => ['required', 'string', 'max:100'],
            'player_name' => ['nullable', 'string', 'max:100'],
            'user_id' => ['nullable', 'integer', 'exists:users,id'],
            'score' => ['required', 'integer', 'min:0'],
            'attempts' => ['nullable', 'integer', 'min:0'],
            'hits' => ['nullable', 'integer', 'min:0'],
            'misses' => ['nullable', 'integer', 'min:0'],
            'avg_reaction_time_ms' => ['nullable', 'integer', 'min:0'],
            'best_reaction_time_ms' => ['nullable', 'integer', 'min:0'],
            'worst_reaction_time_ms' => ['nullable', 'integer', 'min:0'],
            'reaction_times' => ['nullable', 'array'],
            'reaction_times.*' => ['numeric', 'min:0'],
            'duration_ms' => ['nullable', 'integer', 'min:0'],
            'started_at' => ['nullable', 'date'],
            'ended_at' => ['nullable', 'date'],
            'meta' => ['nullable', 'array'],
        ]);

        $session = ReactionSession::create($validated);

        return response()->json([
            'message' => 'Reaction session stored successfully.',
            'data' => $session,
        ], 201);
    }
}
