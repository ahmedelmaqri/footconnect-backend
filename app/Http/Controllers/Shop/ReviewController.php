<?php
namespace App\Http\Controllers\Shop;
use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required|exists:products,id',
            'rating'     => 'required|integer|between:1,5',
            'comment'    => 'nullable|string',
        ]);
        $data['player_id'] = $request->user()->id;

        $existing = Review::where('player_id', $data['player_id'])
            ->where('product_id', $data['product_id'])
            ->first();

        if ($existing) {
            $existing->update($data);
            return response()->json($existing);
        }

        return response()->json(Review::create($data), 201);
    }

    public function destroy(Request $request, $id)
    {
        Review::where('player_id', $request->user()->id)->findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}