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
        $validated = $request->validate([
            'game_name' => ['nullable', 'string', 'max:100'],
            'user_id' => ['nullable', 'integer', 'exists:users,id'],
            'player_name' => ['nullable', 'string', 'max:100'],
            'source_player_id' => ['nullable', 'string', 'max:50'],
            'limit' => ['nullable', 'integer', 'min:1', 'max:200'],
        ]);

        if (!isset($validated['user_id']) && !isset($validated['player_name']) && !isset($validated['source_player_id'])) {
            return response()->json([
                'data' => [],
            ]);
        }

        $limit = $validated['limit'] ?? 100;

        $sessions = DB::table('reaction_sessions')
            ->when(isset($validated['user_id']), function ($query) use ($validated) {
                $query->where('user_id', $validated['user_id']);
            })
            ->when(isset($validated['player_name']), function ($query) use ($validated) {
                $query->where('player_name', $validated['player_name']);
            })
            ->when(isset($validated['source_player_id']), function ($query) use ($validated) {
                $query->where('meta->source_player_id', $validated['source_player_id']);
            })
            ->when(isset($validated['game_name']), function ($query) use ($validated) {
                $mappedName = match (strtolower(trim($validated['game_name']))) {
                    'jungle rush', 'jungle-rush', 'shapematch hue', 'shape-match-hue' => 'jungle-rush',
                    'rapid tiles', 'rapid-tiles' => 'Rapid Tiles',
                    'monkeyball', 'monkey ball', 'monkey-ball' => 'MonkeyBall',
                    'math quest', 'math-quest' => 'Math Quest',
                    default => $validated['game_name'],
                };

                $query->where('game_name', $mappedName);
            })
            ->latest()
            ->limit($limit)
            ->get();

        return response()->json([
            'data' => $sessions,
        ]);
    }
}
