<?php
namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function index()
    {
        return response()->json(Vendor::with('products')->get());
    }

    public function store(Request $request)
{
    $data = $request->validate([
        'shop_name'   => 'required|string|max:255',
        'description' => 'nullable|string',
        'phone'       => 'nullable|string',
        'address'     => 'nullable|string',
        'logo'        => 'nullable|string',
        'banner'      => 'nullable|string',
    ]);

    // Mettre à jour le vendor connecté
    $vendor = $request->user(); // ← c'est déjà le vendor connecté
    $vendor->update($data);
    $vendor->update(['status' => 'pending']);

    return response()->json($vendor, 200);
}

    public function show($id)
    {
        return response()->json(Vendor::with('products')->findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $vendor = Vendor::findOrFail($id);
        $vendor->update($request->all());
        return response()->json($vendor);
    }

    public function destroy($id)
    {
        Vendor::findOrFail($id)->delete();
        return response()->json(null, 204);
    }

    public function approve($id)
    {
        $vendor = Vendor::findOrFail($id);
        $vendor->update(['status' => 'approved']);
        return response()->json($vendor);
    }

    public function reject($id)
    {
        $vendor = Vendor::findOrFail($id);
        $vendor->update(['status' => 'rejected']);
        return response()->json($vendor);
    }
}