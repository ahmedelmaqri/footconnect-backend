<?php
namespace App\Http\Controllers\Shop;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::with('vendor', 'category', 'reviews')
            ->when($request->category_id, fn($q) => $q->where('category_id', $request->category_id))
            ->when($request->brand, fn($q) => $q->where('brand', $request->brand))
            ->when($request->min_price, fn($q) => $q->where('price', '>=', $request->min_price))
            ->when($request->max_price, fn($q) => $q->where('price', '<=', $request->max_price))
            ->when($request->search, fn($q) => $q->where('name', 'like', '%'.$request->search.'%'))
            ->when($request->featured, fn($q) => $q->where('is_featured', true))
            ->where('is_active', true)
            ->orderBy($request->sort_by ?? 'created_at', $request->sort_order ?? 'desc')
            ->paginate($request->per_page ?? 12);

        return response()->json($products);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'vendor_id'   => 'required|exists:vendors,id',
            'category_id' => 'required|exists:categories,id',
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'sale_price'  => 'nullable|numeric|min:0',
            'stock'       => 'integer|min:0',
            'images'      => 'nullable|array',
            'sizes'       => 'nullable|array',
            'colors'      => 'nullable|array',
            'brand'       => 'nullable|string',
            'is_featured' => 'boolean',
        ]);
        $data['slug'] = Str::slug($data['name']) . '-' . uniqid();
        return response()->json(Product::create($data), 201);
    }

    public function show($id)
    {
        $product = Product::with('vendor', 'category', 'reviews.player')->findOrFail($id);
        $product->increment('views');
        return response()->json($product);
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->all());
        return response()->json($product);
    }

    public function destroy($id)
    {
        Product::findOrFail($id)->delete();
        return response()->json(null, 204);
    }

    public function featured()
    {
        return response()->json(
            Product::with('vendor', 'category')
                ->where('is_featured', true)
                ->where('is_active', true)
                ->latest()
                ->take(8)
                ->get()
        );
    }

    public function topSellers()
    {
        return response()->json(
            Product::with('vendor', 'category')
                ->where('is_active', true)
                ->orderByDesc('views')
                ->take(8)
                ->get()
        );
    }
}