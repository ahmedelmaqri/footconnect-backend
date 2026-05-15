<?php
namespace App\Http\Controllers;
use App\Models\Workout;
use Illuminate\Http\Request;

class WorkoutController extends Controller
{
    public function index(Request $request)
    {
        $workouts = Workout::with('player')
            ->when($request->player_id, fn($q) => $q->where('player_id', $request->player_id))
            ->orderBy('assigned_date', 'desc')
            ->get();
        return response()->json($workouts);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'player_id'        => 'required|exists:players,id',
            'title'            => 'required|string',
            'description'      => 'nullable|string',
            'exercises'        => 'required|array',
            'difficulty'       => 'in:facile,moyen,difficile,extreme',
            'duration_minutes' => 'integer|min:1',
            'assigned_date'    => 'required|date',
            'notes'            => 'nullable|string',
        ]);
        return response()->json(Workout::create($data), 201);
    }

    public function show($id)
    {
        return response()->json(Workout::with('player')->findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $workout = Workout::findOrFail($id);
        $workout->update($request->all());
        return response()->json($workout);
    }

    public function destroy($id)
    {
        Workout::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}