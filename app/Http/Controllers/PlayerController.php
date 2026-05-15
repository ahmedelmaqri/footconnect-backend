<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function index(Request $request)
    {
        $players = User::when($request->position, 
                fn($q) => $q->where('position', $request->position))
            ->when($request->team_id, 
                fn($q) => $q->where('team_id', $request->team_id))
            ->paginate(20);

        return response()->json($players);
    }

    public function show($id)
    {
        $player = User::with('stats')->findOrFail($id);
        return response()->json($player);
    }

    public function update(Request $request, $id)
    {
        $player = User::findOrFail($id);

        $data = $request->validate([
            'name'          => 'sometimes|string|max:255',
            'position'      => 'nullable|string',
            'team_id'       => 'nullable|string',
            'avatar'        => 'nullable|string',
            'date_of_birth' => 'nullable|string',
            'nationality'   => 'nullable|string',
        ]);

        $player->update($data);
        return response()->json($player);
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return response()->json(null, 204);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|unique:users,email',
            'password'      => 'required|string|min:8',
            'position'      => 'nullable|string',
            'team_id'       => 'nullable|string',
            'nationality'   => 'nullable|string',
            'date_of_birth' => 'nullable|string',
        ]);

        $data['password'] = bcrypt($data['password']);
        $player = User::create($data);

        return response()->json($player, 201);
    }
}