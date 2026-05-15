<?php

namespace App\Http\Controllers;

use App\Models\FootMatch;
use Illuminate\Http\Request;

class MatchController extends Controller
{
    public function index(Request $request)
    {
        $matches = FootMatch::when($request->season,
                fn($q) => $q->where('season', $request->season))
            ->when($request->status,
                fn($q) => $q->where('status', $request->status))
            ->orderByDesc('date')
            ->paginate(20);

        return response()->json($matches);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'home_team_id' => 'required|string',
            'away_team_id' => 'required|string',
            'date'         => 'required|date',
            'venue'        => 'nullable|string',
            'competition'  => 'nullable|string',
            'season'       => 'required|string',
            'status'       => 'in:scheduled,live,finished',
            'home_score'   => 'nullable|integer|min:0',
            'away_score'   => 'nullable|integer|min:0',
        ]);

        $match = FootMatch::create($data);
        return response()->json($match, 201);
    }

    public function show($id)
    {
        $match = FootMatch::with('stats')->findOrFail($id);
        return response()->json($match);
    }

    public function update(Request $request, $id)
    {
        $match = FootMatch::findOrFail($id);
        $match->update($request->all());
        return response()->json($match);
    }

    public function destroy($id)
    {
        FootMatch::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}