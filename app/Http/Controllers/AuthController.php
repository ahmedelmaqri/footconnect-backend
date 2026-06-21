<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:players,email',
            'password' => 'required|string|min:8|confirmed',
            'position' => 'nullable|string',
        ]);

        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
            'position' => $data['position'] ?? null,
        ]);

        $token = $user->createToken('footconnect')->plainTextToken;
        return response()->json(['token' => $token, 'user' => $user], 201);
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
            'role'     => 'required|in:joueur,admin,vendor',
        ]);

        $model = match($data['role']) {
            'joueur' => User::class,
            'vendor' => Vendor::class,
            'admin'  => Admin::class,
        };

        $user = $model::where('email', $data['email'])->first();

        if (! $user || ! Hash::check($data['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Identifiants incorrects.'],
            ]);
        }

        $token = $user->createToken('footconnect')->plainTextToken;

        return response()->json([
            'token' => $token,
            'user'  => $user,
            'role'  => $data['role'],
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Déconnecté.']);
    }

    public function me(Request $request)
    {
        return response()->json($request->user());
    }
}