<?php

namespace App\Http\Controllers;

use App\Models\Stat;
use Illuminate\Http\Request;

class StatsController extends Controller
{
    public function index(Request $request)
    {
        $stats = Stat::with('player')
            ->when($request->season, fn($q) => $q->where('season', $request->season))
            ->paginate(20);

        return response()->json($stats);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'player_id'      => 'required|string',
            'match_id'       => 'nullable|string',
            'season'         => 'required|string',
            'goals'          => 'nullable|integer|min:0',
            'assists'        => 'nullable|integer|min:0',
            'minutes_played' => 'nullable|integer|min:0',
            'distance_km'    => 'nullable|numeric|min:0',
            'passes'         => 'nullable|integer|min:0',
            'pass_accuracy'  => 'nullable|numeric|between:0,100',
            'rating'         => 'nullable|numeric|between:0,10',
            'yellow_cards'   => 'nullable|integer|min:0',
            'red_cards'      => 'nullable|integer|min:0',
        ]);

        $stat = Stat::create($data);

        return response()->json($stat, 201);
    }

    public function show($id)
    {
        return response()->json(Stat::with('player')->findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $stat = Stat::findOrFail($id);
        $stat->update($request->all());
        return response()->json($stat);
    }

    public function destroy($id)
    {
        Stat::findOrFail($id)->delete();
        return response()->json(null, 204);
    }

    public function byPlayer($playerId)
    {
        $stats = Stat::where('player_id', $playerId)->get();

        $aggregated = [
            'total_goals'    => $stats->sum('goals'),
            'total_assists'  => $stats->sum('assists'),
            'total_minutes'  => $stats->sum('minutes_played'),
            'total_distance' => round($stats->sum('distance_km'), 1),
            'avg_rating'     => round($stats->avg('rating'), 2),
            'matches_played' => $stats->count(),
        ];

        return response()->json([
            'aggregated' => $aggregated,
            'detail'     => $stats,
        ]);
    }

    public function byMatch($matchId)
    {
        $stats = Stat::with('player')->where('match_id', $matchId)->get();
        return response()->json($stats);
    }

    public function topScorers(Request $request)
    {
        $stats = Stat::when($request->season, fn($q) => $q->where('season', $request->season))
            ->get()
            ->groupBy('player_id')
            ->map(fn($group) => [
                'player_id' => $group->first()->player_id,
                'name'      => $group->first()->player?->name ?? '—',
                'goals'     => $group->sum('goals'),
                'assists'   => $group->sum('assists'),
            ])
            ->sortByDesc('goals')
            ->take(10)
            ->values();

        return response()->json($stats);
    }

    public function byTeam($teamId)
    {
        $stats = Stat::where('team_id', $teamId)->get();
        return response()->json([
            'total_goals'   => $stats->sum('goals'),
            'total_assists' => $stats->sum('assists'),
            'total_passes'  => $stats->sum('passes'),
            'avg_rating'    => round($stats->avg('rating'), 2),
        ]);
    }
}