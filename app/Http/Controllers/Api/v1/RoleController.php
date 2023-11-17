<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{
  public function index()
  {
    $roles = Role::all();

    return response()->json([
      'data' => $roles,
    ]);
  }

  public function store(Request $request)
  {
    if (Gate::allows('tambah-role')) {
      $request->validate([
        'name' => 'required|string|unique:roles',
        'permissions.*' => Rule::in(Permission::pluck('id')->toArray()),
      ]);

      $role = Role::create(['name' => $request->input('name'), 'guard_name' => 'web']);

      $permissions = $request->input('permissions');

      // tambahkan permission yang dipilih ke role
      $role->permissions()->attach($permissions);
      return response()->json([
        'message' => 'Role berhasil dibuat',
        'data' => $role,
      ]);
    } else {
      return response()->json(['error' => 'Unauthorized'], 401);
    }
  }

  public function update(Request $request, $id)
  {
    if (Gate::allows('ubah-role', $id)) {
      $role = Role::findOrFail($id);
      $role->update($request->only('name'));

      $permissions = $request->input('permissions', []);
      $role->permissions()->sync($permissions);

      return response()->json([
        'message' => 'Role berhasil diubah',
        'data' => $role,
      ]);
    } else {
      return response()->json(['error' => 'Unauthorized'], 401);
    }
  }

  public function destroy(Role $role) 
  {
    if (Gate::allows('hapus-role', $role)) {
      
      $role->delete();

      return response()->json([
        'message' => 'Role berhasil dihapus',
      ]);
    } else {
      return response()->json(['error' => 'Unauthorized'], 401);
    }
  }

  public function show(Role $role)
  {
    return response()->json([
      'data' => $role,
    ]);
  }
}
