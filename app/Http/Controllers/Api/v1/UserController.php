<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
  public function index()
  {
    $users = User::all();

    return response()->json([
      'data' => $users,
    ]);
  }

  public function store(Request $request)
  {
    // Memeriksa apakah pengguna terotentikasi
    if (Gate::allows('tambah-user')) {
      // Mengambil instance pengguna yang terotentikasi
      $user = Auth::user();

      // Melakukan validasi input data pengguna baru sesuai kebutuhan
      $validatedData = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'level_akses' => ['required'],
        'satuan_kerja' => ['nullable'],
        'password' => [
          'required',
          'string',
          Password::min(8)
            ->mixedCase()
            ->letters()
            ->numbers()
            ->symbols()
        ],
        'is_active' => 'nullable'
      ]);

      $validatedData['password'] = Hash::make($validatedData['password']);
      $validatedData['is_active'] = $request->input('is_active', 0);

      $user = User::create($validatedData);

      $roles = $request->input('roles');

      $user->assignRole($roles);

      return response()->json([
        'message' => 'Pengguna berhasil dibuat',
        'user' => $user,
      ]);
    } else {
      return response()->json(['error' => 'Unauthorized'], 401);
    }
  }

  public function update(Request $request, User $user)
  {
    // Memeriksa apakah pengguna terotentikasi
    if (Gate::allows('ubah-user', $user)) {
      // Melakukan validasi input data pengguna yang diubah sesuai kebutuhan
      $validatedData = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => [
          'required', 'string', 'email', 'max:255',
          Rule::unique('users')->ignore($user->id)
        ],
        'level_akses' => ['required'],
        'satuan_kerja' => ['nullable'],
        'password' => [
          'nullable', 'string',
          Password::min(8)
            ->mixedCase()
            ->letters()
            ->numbers()
            ->symbols()
        ],
        'is_active' => 'nullable'
      ]);

      // Update data pengguna
      $user->update($validatedData);

      // Assign roles jika diberikan
      $roles = $request->input('roles');
      if ($roles) {
        $user->syncRoles($roles);
      }

      return response()->json([
        'message' => 'Pengguna berhasil diupdate',
        'user' => $user,
      ]);
    } else {
      return response()->json(['error' => 'Unauthorized'], 401);
    }
  }

  public function destroy(User $user)
  {
    // Memeriksa apakah pengguna terotentikasi dan memiliki izin untuk menghapus pengguna
    if (Gate::allows('hapus-user', $user)) {

      // Hapus pengguna
      $user->delete();

      return response()->json([
        'message' => 'Pengguna berhasil dihapus',
      ]);
    } else {
      return response()->json(['error' => 'Unauthorized'], 401);
    }
  }

  public function show(User $user)
  {
    return response()->json([
      'data' => $user,
    ]);
  }
}
