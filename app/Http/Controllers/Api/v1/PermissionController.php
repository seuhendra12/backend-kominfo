<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PermissionController extends Controller
{
  public function index()
  {
    $permissions = Permission::all();

    return response()->json([
      'data' => $permissions,
    ]);
  }

  public function store(Request $request)
  {
    if (Gate::allows('tambah-permission')) {
      $request->validate([
        'name' => 'required|unique:permissions',
      ]);

      $permission = new Permission();
      $permission->name = $request->input('name');
      $permission->guard_name = 'web';
      $permission->save();

      return response()->json([
        'message' => 'Permission berhasil dibuat',
        'data' => $permission,
      ]);
    } else {
      return response()->json(['error' => 'Unauthorized'], 401);
    }
  }

  public function update(Request $request, $id)
  {
    if (Gate::allows('ubah-permission', $id)) {
      $permission = Permission::findOrFail($id);
      $permission->update($request->only('name'));

      return response()->json([
        'message' => 'Permission berhasil diubah',
        'data' => $permission,
      ]);
    } else {
      return response()->json(['error' => 'Unauthorized'], 401);
    }
  }

  public function destroy(Permission $permission)
  {
    if (Gate::allows('hapus-permission', $permission)) {
      
      $permission->delete();

      return response()->json([
        'message' => 'Permission berhasil dihapus',
      ]);
    } else {
      return response()->json(['error' => 'Unauthorized'], 401);
    }
  }

  public function show(Permission $permission)
  {
    return response()->json([
      'data' => $permission,
    ]);
  }
}
