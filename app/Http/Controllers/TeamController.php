<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index()
    {
        return response()->json(Team::all());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'         => 'required|string|max:255',
            'city'         => 'nullable|string',
            'country'      => 'nullable|string',
            'founded_year' => 'nullable|integer',
            'coach'        => 'nullable|string',
            'logo'         => 'nullable|string',
        ]);

        $team = Team::create($data);
        return response()->json($team, 201);
    }

    public function show($id)
    {
        return response()->json(Team::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $team = Team::findOrFail($id);
        $team->update($request->all());
        return response()->json($team);
    }

    public function destroy($id)
    {
        Team::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}