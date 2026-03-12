<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string',
        ]);

        $user = User::create($validated);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'token' => $token,
        ]);
    }

    public function login(Request $request) {
        $validated = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        if(!Auth::attempt($validated)){
            return response()->json(['message' => 'Invalid credentials'] , 401);
        }

        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'token' => $token,
        ]);
    }


    public function userStats(){
        $stats = User::select(\DB::raw("EXTRACT(MONTH FROM created_at) as month"), \DB::raw('count(*) as total_users'))->groupBy('month')->get();

        return response()->json($stats);
    }
}
