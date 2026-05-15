<?php
namespace App\Http\Controllers;
use App\Models\Resignation;
use Illuminate\Http\Request;

class ResignationController extends Controller
{
    public function index(Request $request)
    {
        $resignations = Resignation::with('player', 'team')
            ->when($request->status, fn($q) => $q->where('status', $request->status))
            ->when($request->player_id, fn($q) => $q->where('player_id', $request->player_id))
            ->orderBy('created_at', 'desc')
            ->get();
        return response()->json($resignations);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'player_id'         => 'required|exists:players,id',
            'team_id'           => 'nullable|exists:teams,id',
            'reason'            => 'required|string',
            'requested_date'    => 'required|date',
            'desired_leave_date'=> 'nullable|date',
        ]);
        $data['status'] = 'pending';
        return response()->json(Resignation::create($data), 201);
    }

    public function show($id)
    {
        return response()->json(Resignation::with('player', 'team')->findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $resignation = Resignation::findOrFail($id);
        $resignation->update($request->all());
        return response()->json($resignation);
    }

    public function approve(Request $request, $id)
    {
        $resignation = Resignation::findOrFail($id);
        $resignation->update([
            'status'         => 'approved',
            'admin_response' => $request->admin_response,
        ]);
        return response()->json($resignation);
    }

    public function reject(Request $request, $id)
    {
        $resignation = Resignation::findOrFail($id);
        $resignation->update([
            'status'         => 'rejected',
            'admin_response' => $request->admin_response,
        ]);
        return response()->json($resignation);
    }

    public function destroy($id)
    {
        Resignation::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}