<?php
namespace App\Http\Controllers;
use App\Models\Training;
use Illuminate\Http\Request;

class TrainingController extends Controller
{
    public function index(Request $request)
    {
        $trainings = Training::with('player', 'team')
            ->when($request->player_id, fn($q) => $q->where('player_id', $request->player_id))
            ->when($request->team_id, fn($q) => $q->where('team_id', $request->team_id))
            ->orderBy('date', 'desc')
            ->get();
        return response()->json($trainings);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|string',
            'description' => 'nullable|string',
            'date'        => 'required|date',
            'start_time'  => 'required',
            'end_time'    => 'required',
            'location'    => 'nullable|string',
            'type'        => 'in:collectif,individuel,physique,tactique,technique',
            'status'      => 'in:planifie,en_cours,termine,annule',
            'team_id'     => 'nullable|exists:teams,id',
            'player_id'   => 'nullable|exists:players,id',
        ]);
        return response()->json(Training::create($data), 201);
    }

    public function show($id)
    {
        return response()->json(Training::with('player', 'team')->findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $training = Training::findOrFail($id);
        $training->update($request->all());
        return response()->json($training);
    }

    public function destroy($id)
    {
        Training::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}