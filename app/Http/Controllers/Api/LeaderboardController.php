<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ReactionSession;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LeaderboardController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'game_name' => ['nullable', 'string', 'max:100'],
            'difficulty' => ['nullable', 'string', 'in:all,easy,normal,hard,extreme'],
            'sort_by' => ['nullable', 'string', 'in:highest_score,most_accurate,most_sessions,fastest_reaction,highest_combo,longest_played,fastest_solve'],
            'limit' => ['nullable', 'integer', 'min:1', 'max:10000'],
        ]);

        $limit = $validated['limit'] ?? 10000;
        $difficulty = $validated['difficulty'] ?? 'all';
        $sortBy = $validated['sort_by'] ?? 'highest_score';

        $sessions = ReactionSession::query()
            ->when(isset($validated['game_name']), function ($query) use ($validated) {
                $query->where('game_name', $validated['game_name']);
            })
            ->orderByDesc('created_at')
            ->get();

        if ($difficulty !== 'all') {
            $sessions = $sessions->filter(function (ReactionSession $session) use ($difficulty) {
                return $this->extractDifficulty($session) === $difficulty;
            })->values();
        }

        $games = $sessions
            ->groupBy(function (ReactionSession $session) {
                return $session->game_name;
            })
            ->map(function ($gameSessions, $gameName) use ($limit, $sortBy) {
                $players = $gameSessions
                    ->groupBy(function (ReactionSession $session) {
                        return $session->player_name ?: 'Unknown Player';
                    })
                    ->map(function ($playerSessions, $playerName) {
                        $scores = $playerSessions->pluck('score')->filter(function ($value) {
                            return is_numeric($value);
                        });

                        $durations = $playerSessions->pluck('duration_ms')->filter(function ($value) {
                            return is_numeric($value);
                        });

                        $reactionTimes = $playerSessions->pluck('avg_reaction_time_ms')->filter(function ($value) {
                            return is_numeric($value);
                        });

                        $combos = $playerSessions->pluck('hits')->filter(function ($value) {
                            return is_numeric($value);
                        });

                        $hits = $playerSessions->pluck('hits')->filter(function ($value) {
                            return is_numeric($value);
                        });

                        $solveTimes = $playerSessions->pluck('avg_reaction_time_ms')->filter(function ($value) {
                            return is_numeric($value);
                        });

                        $accuracies = $playerSessions->map(function (ReactionSession $session) {
                            $metaAccuracy = data_get($session->meta, 'accuracy');
                            if (is_numeric($metaAccuracy)) {
                                $metaAccuracy = (float) $metaAccuracy;
                                return max(0, min(100, $metaAccuracy));
                            }

                            $hits = $session->hits;
                            $attempts = $session->attempts;

                            if (!is_numeric($hits) || !is_numeric($attempts) || (float) $attempts <= 0) {
                                return null;
                            }

                            $percent = ((float) $hits / (float) $attempts) * 100;
                            return max(0, min(100, $percent));
                        })->filter(function ($value) {
                            return is_numeric($value);
                        });

                        return [
                            'player_name' => $playerName,
                            'highest_score' => $scores->isNotEmpty() ? (int) $scores->max() : 0,
                            'highest_accuracy' => $accuracies->isNotEmpty() ? round((float) $accuracies->max(), 1) : null,
                            'longest_played_ms' => $durations->isNotEmpty() ? (int) $durations->max() : null,
                            'fastest_reaction_ms' => $reactionTimes->isNotEmpty() ? (int) round((float) $reactionTimes->average()) : null,
                            'highest_combo' => $combos->isNotEmpty() ? (int) $combos->max() : null,
                            'best_hits' => $hits->isNotEmpty() ? (int) $hits->max() : null,
                            'fastest_solve_time_ms' => $solveTimes->isNotEmpty() ? (int) round((float) $solveTimes->average()) : null,
                            'sessions_played' => $playerSessions->count(),
                        ];
                    })
                    ->values()
                    ->all();

                usort($players, function (array $left, array $right) use ($sortBy) {
                    if ($sortBy === 'most_accurate') {
                        return [$right['highest_accuracy'] ?? -1, $right['highest_score'], $right['sessions_played']]
                            <=>
                            [$left['highest_accuracy'] ?? -1, $left['highest_score'], $left['sessions_played']];
                    }

                    if ($sortBy === 'most_sessions') {
                        return [$right['sessions_played'], $right['highest_score'], $right['highest_accuracy'] ?? -1]
                            <=>
                            [$left['sessions_played'], $left['highest_score'], $left['highest_accuracy'] ?? -1];
                    }

                    if ($sortBy === 'fastest_reaction') {
                        return [$left['fastest_reaction_ms'] ?? 99999, $right['highest_score']]
                            <=>
                            [$right['fastest_reaction_ms'] ?? 99999, $left['highest_score']];
                    }

                    if ($sortBy === 'highest_combo') {
                        return [$right['highest_combo'] ?? -1, $right['highest_score']]
                            <=>
                            [$left['highest_combo'] ?? -1, $left['highest_score']];
                    }

                    if ($sortBy === 'longest_played') {
                        return [$right['longest_played_ms'] ?? -1, $right['highest_score']]
                            <=>
                            [$left['longest_played_ms'] ?? -1, $left['highest_score']];
                    }

                    if ($sortBy === 'fastest_solve') {
                        return [$left['fastest_solve_time_ms'] ?? 99999, $right['highest_score']]
                            <=>
                            [$right['fastest_solve_time_ms'] ?? 99999, $left['highest_score']];
                    }

                    return [$right['highest_score'], $right['highest_accuracy'] ?? -1, $right['sessions_played']]
                        <=>
                        [$left['highest_score'], $left['highest_accuracy'] ?? -1, $left['sessions_played']];
                });

                $players = array_slice($players, 0, $limit);

                return [
                    'game_name' => $gameName,
                    'players' => $players,
                ];
            })
            ->values()
            ->all();

        return response()->json([
            'data' => $games,
            'filters' => [
                'difficulty' => $difficulty,
                'sort_by' => $sortBy,
            ],
        ]);
    }

    private function extractDifficulty(ReactionSession $session): ?string
    {
        $difficulty = data_get($session->meta, 'difficulty') ?? data_get($session->meta, 'level');

        if (!is_string($difficulty)) {
            return null;
        }

        $normalized = strtolower(trim($difficulty));
        if (in_array($normalized, ['easy', 'normal', 'hard', 'extreme'], true)) {
            return $normalized;
        }

        return null;
    }
}
