<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrackProgressController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $games = [
            'Jungle Rush',
            'Rapid Tiles',
            'MonkeyBall',
            'Math Quest',
        ];

        $stats = [];

        foreach ($games as $game) {
            $stats[$game] = [
                'best_accuracy' => null,
                'best_score' => null,
                'best_duration_ms' => null,
                'avg_reaction' => null,
                'sessions' => 0,
                'difficulty' => [
                    'easy' => ['sessions' => 0, 'total_score' => 0, 'total_accuracy' => 0, 'total_rt' => 0],
                    'normal' => ['sessions' => 0, 'total_score' => 0, 'total_accuracy' => 0, 'total_rt' => 0],
                    'hard' => ['sessions' => 0, 'total_score' => 0, 'total_accuracy' => 0, 'total_rt' => 0],
                    'all' => ['sessions' => 0, 'total_score' => 0, 'total_accuracy' => 0, 'total_rt' => 0],
                ],
            ];
        }

        if ($user) {
            $rows = DB::table('reaction_sessions')
                ->where('user_id', $user->id)
                ->orderByDesc('created_at')
                ->get();

            foreach ($rows as $row) {
                $game = $row->game_name ?? 'Unknown';
                if (!isset($stats[$game])) {
                    continue;
                }

                $meta = null;
                if ($row->meta) {
                    try {
                        $meta = json_decode($row->meta, true);
                    } catch (\Throwable $e) {
                        $meta = null;
                    }
                }

                $attempts = $row->attempts ?: ($meta['attempts'] ?? null);
                $hits = $row->hits ?: ($meta['hits'] ?? null);
                $accuracy = null;
                if ($attempts && $hits !== null) {
                    $accuracy = $attempts > 0 ? ($hits / $attempts) * 100.0 : 0.0;
                } elseif (!empty($meta['accuracy'])) {
                    $accuracy = floatval($meta['accuracy']);
                }

                $avg_rt = $row->avg_reaction_time_ms ?: ($meta['avg_reaction_time_ms'] ?? null);
                $difficulty = strtolower(($meta['difficulty'] ?? ($row->meta && isset($meta['difficulty']) ? $meta['difficulty'] : 'all')));
                if (!in_array($difficulty, ['easy','normal','hard'])) {
                    $difficulty = 'normal';
                }

                // update overall
                $s = &$stats[$game];
                $s['sessions'] += 1;
                // best score
                if (isset($row->score)) {
                    if ($s['best_score'] === null || $row->score > $s['best_score']) {
                        $s['best_score'] = $row->score;
                    }
                }
                // best duration
                if (isset($row->duration_ms)) {
                    if ($s['best_duration_ms'] === null || $row->duration_ms > $s['best_duration_ms']) {
                        $s['best_duration_ms'] = $row->duration_ms;
                    }
                }
                if ($accuracy !== null) {
                    if ($s['best_accuracy'] === null || $accuracy > $s['best_accuracy']) {
                        $s['best_accuracy'] = $accuracy;
                    }
                    $s['difficulty']['all']['total_accuracy'] += $accuracy;
                }
                if ($avg_rt !== null) {
                    $s['difficulty']['all']['total_rt'] += $avg_rt;
                }
                $s['difficulty']['all']['sessions'] += 1;
                $s['difficulty']['all']['total_score'] += ($row->score ?? 0);

                // per difficulty
                $d = &$s['difficulty'][$difficulty];
                $d['sessions'] += 1;
                $d['total_score'] += ($row->score ?? 0);
                if ($accuracy !== null) $d['total_accuracy'] += $accuracy;
                if ($avg_rt !== null) $d['total_rt'] += $avg_rt;
            }

            // compute averages
            foreach ($stats as $g => &$s) {
                if ($s['sessions'] > 0) {
                    $all = $s['difficulty']['all'];
                    $s['avg_reaction'] = $all['sessions'] ? round($all['total_rt'] / $all['sessions']) : null;
                    if ($s['best_accuracy'] !== null) {
                        $s['best_accuracy'] = round($s['best_accuracy'], 1);
                    }
                }

                foreach (['easy','normal','hard','all'] as $k) {
                    $dd = &$s['difficulty'][$k];
                    if ($dd['sessions'] > 0) {
                        $dd['avg_score'] = round($dd['total_score'] / max(1, $dd['sessions']));
                        $dd['avg_accuracy'] = $dd['sessions'] ? round($dd['total_accuracy'] / $dd['sessions'], 1) : null;
                        $dd['avg_reaction'] = $dd['sessions'] ? round($dd['total_rt'] / $dd['sessions']) : null;
                    } else {
                        $dd['avg_score'] = null;
                        $dd['avg_accuracy'] = null;
                        $dd['avg_reaction'] = null;
                    }
                }
            }
            unset($s);
        }

        return view('layouts.track-progress', ['stats' => $stats]);
    }
}
