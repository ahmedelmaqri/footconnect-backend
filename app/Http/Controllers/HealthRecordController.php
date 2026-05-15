<?php
namespace App\Http\Controllers;
use App\Models\HealthRecord;
use Illuminate\Http\Request;

class HealthRecordController extends Controller
{
    public function index(Request $request)
    {
        $records = HealthRecord::with('player')
            ->when($request->player_id, fn($q) => $q->where('player_id', $request->player_id))
            ->orderBy('date', 'desc')
            ->get();
        return response()->json($records);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'player_id'          => 'required|exists:players,id',
            'date'               => 'required|date',
            'weight'             => 'nullable|numeric',
            'height'             => 'nullable|numeric',
            'heart_rate'         => 'nullable|integer',
            'blood_pressure_sys' => 'nullable|integer',
            'blood_pressure_dia' => 'nullable|integer',
            'fitness_level'      => 'in:excellent,bon,moyen,faible',
            'injury_status'      => 'in:aucune,legere,moderee,grave',
            'injury_description' => 'nullable|string',
            'notes'              => 'nullable|string',
        ]);
        return response()->json(HealthRecord::create($data), 201);
    }

    public function show($id)
    {
        return response()->json(HealthRecord::with('player')->findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $record = HealthRecord::findOrFail($id);
        $record->update($request->all());
        return response()->json($record);
    }

    public function destroy($id)
    {
        HealthRecord::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}