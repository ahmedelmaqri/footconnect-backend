<?php
namespace App\Http\Controllers\Shop;
use App\Http\Controllers\Controller;
use App\Models\CartItem;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $items = CartItem::with('product.category')
            ->where('player_id', $request->user()->id)
            ->get();
        return response()->json($items);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'integer|min:1',
            'size'       => 'nullable|string',
            'color'      => 'nullable|string',
        ]);
        $data['player_id'] = $request->user()->id;

        $existing = CartItem::where('player_id', $data['player_id'])
            ->where('product_id', $data['product_id'])
            ->where('size', $data['size'] ?? null)
            ->where('color', $data['color'] ?? null)
            ->first();

        if ($existing) {
            $existing->increment('quantity', $data['quantity'] ?? 1);
            return response()->json($existing);
        }

        return response()->json(CartItem::create($data), 201);
    }

    public function update(Request $request, $id)
    {
        $item = CartItem::where('player_id', $request->user()->id)->findOrFail($id);
        $item->update(['quantity' => $request->quantity]);
        return response()->json($item);
    }

    public function destroy(Request $request, $id)
    {
        CartItem::where('player_id', $request->user()->id)->findOrFail($id)->delete();
        return response()->json(null, 204);
    }

    public function clear(Request $request)
    {
        CartItem::where('player_id', $request->user()->id)->delete();
        return response()->json(['message' => 'Panier vidé.']);
    }
}