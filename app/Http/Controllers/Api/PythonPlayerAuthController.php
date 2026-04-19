<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ReactionSession;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PythonPlayerAuthController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'username' => ['required', 'string', 'max:100'],
            'player_id' => ['required', 'string', 'max:50'],
        ]);

        $username = trim($validated['username']);
        $playerId = trim($validated['player_id']);

        $session = ReactionSession::query()
            ->where('meta->source_player_id', $playerId)
            ->whereRaw('LOWER(player_name) = ?', [Str::lower($username)])
            ->latest()
            ->first();

        if ($session) {
            return response()->json([
                'message' => 'Login successful.',
                'data' => [
                    'username' => $session->player_name,
                    'player_id' => $playerId,
                    'user_id' => $session->user_id,
                ],
            ]);
        }

        $slug = Str::of($username)->lower()->replaceMatches('/[^a-z0-9]+/', '.')->trim('.')->value();
        $email = ($slug !== '' ? $slug : 'player') . '.' . Str::lower($playerId) . '@fyp.test';

        $user = User::query()->where('email', $email)->first();
        if ($user) {
            return response()->json([
                'message' => 'Login successful.',
                'data' => [
                    'username' => $user->name,
                    'player_id' => $playerId,
                    'user_id' => $user->id,
                ],
            ]);
        }

        return response()->json([
            'message' => 'Player account not found. Please sync your Python game data first.',
        ], 401);
    }
}
