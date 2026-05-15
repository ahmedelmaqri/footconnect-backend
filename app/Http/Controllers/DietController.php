<?php
namespace App\Http\Controllers;
use App\Models\Diet;
use Illuminate\Http\Request;

class DietController extends Controller
{
    public function index(Request $request)
    {
        $diets = Diet::with('player')
            ->when($request->player_id, fn($q) => $q->where('player_id', $request->player_id))
            ->orderBy('start_date', 'desc')
            ->get();
        return response()->json($diets);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'player_id'       => 'required|exists:players,id',
            'title'           => 'required|string',
            'breakfast'       => 'required|array',
            'lunch'           => 'required|array',
            'dinner'          => 'required|array',
            'snacks'          => 'nullable|array',
            'calories_target' => 'integer|min:0',
            'notes'           => 'nullable|string',
            'start_date'      => 'required|date',
            'end_date'        => 'nullable|date',
        ]);
        return response()->json(Diet::create($data), 201);
    }

    public function show($id)
    {
        return response()->json(Diet::with('player')->findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $diet = Diet::findOrFail($id);
        $diet->update($request->all());
        return response()->json($diet);
    }

    public function destroy($id)
    {
        Diet::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}