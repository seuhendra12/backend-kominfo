<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
  public function login(Request $request)
  {
    $credentials = $request->only('email', 'password');

    $user = User::where('email', $credentials['email'])->first();

    if ($user) {
      if (Hash::check($credentials['password'], $user->password)) {
        $accessToken = $user->createToken('authToken')->plainTextToken;

        return response()->json([
          'message' => 'Login berhasil',
          'user' => $user,
          'access_token' => $accessToken
        ]);
      } else {
        return response()->json(['error' => 'Password yang Anda masukkan salah.'], 401);
      }
    } else {
      return response()->json(['error' => 'Email yang Anda masukkan tidak terdaftar.'], 401);
    }
  }

  public function logout(Request $request)
  {
    $request->user()->currentAccessToken()->delete();
    return response()->json(['message' => 'Logged out successfully']);
  }
}
