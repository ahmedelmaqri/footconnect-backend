<?php
namespace App\Http\Controllers\Shop;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::with('items.product')
            ->where('player_id', $request->user()->id)
            ->latest()
            ->get();
        return response()->json($orders);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'payment_method'   => 'required|in:stripe,cash_on_delivery',
            'shipping_address' => 'required|string',
            'shipping_city'    => 'required|string',
            'shipping_country' => 'required|string',
            'shipping_phone'   => 'required|string',
            'notes'            => 'nullable|string',
            'stripe_payment_id'=> 'nullable|string',
        ]);

        $cartItems = CartItem::with('product')
            ->where('player_id', $request->user()->id)
            ->get();

        if ($cartItems->isEmpty()) {
            return response()->json(['message' => 'Panier vide.'], 400);
        }

        $total = $cartItems->sum(fn($item) =>
            ($item->product->sale_price ?? $item->product->price) * $item->quantity
        );

        $order = Order::create([
            ...$data,
            'player_id'      => $request->user()->id,
            'order_number'   => 'FC-' . strtoupper(Str::random(8)),
            'total'          => $total,
            'payment_status' => $data['payment_method'] === 'cash_on_delivery' ? 'pending' : 'paid',
        ]);

        foreach ($cartItems as $item) {
            $order->items()->create([
                'product_id' => $item->product_id,
                'quantity'   => $item->quantity,
                'price'      => $item->product->sale_price ?? $item->product->price,
                'size'       => $item->size,
                'color'      => $item->color,
            ]);
            $item->product->decrement('stock', $item->quantity);
        }

        CartItem::where('player_id', $request->user()->id)->delete();

        return response()->json($order->load('items.product'), 201);
    }

    public function show(Request $request, $id)
    {
        $order = Order::with('items.product')
            ->where('player_id', $request->user()->id)
            ->findOrFail($id);
        return response()->json($order);
    }

    public function allOrders()
    {
        return response()->json(
            Order::with('player', 'items.product')->latest()->paginate(20)
        );
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->update(['status' => $request->status]);
        return response()->json($order);
    }
}