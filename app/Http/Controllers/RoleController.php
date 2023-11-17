<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Artisan;

class RoleController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    Artisan::call('cache:clear');

    $sort = $request->query('sort');
    $perPage = $request->query('perPage', 10);

    if ($sort == 'asc') {
      $roles = Role::orderBy('name')->filter(request(['search']))->paginate($perPage);
    } else if ($sort == 'desc') {
      $roles = Role::orderByDesc('name')->filter(request(['search']))->paginate($perPage);
    } else {
      $roles = Role::latest()->filter(request(['search']))->paginate($perPage);
    }

    return view('dashboard.manajemen-pengguna.role.index', [
      'roles' => $roles,
      'permissions' => Permission::all(),
      'sort' => $sort,
      'perPage' => $perPage
    ]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('dashboard.manajemen-pengguna.role.create', [
      'permissions' => Permission::all(),
    ], [
      'name.required' => 'Kolom nama wajib diisi',
    ]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {

    $request->validate([
      'name' => 'required|string|unique:roles',
      'permissions.*' => Rule::in(Permission::pluck('id')->toArray()),
    ]);

    $role = Role::create(['name' => $request->input('name'), 'guard_name' => 'web']);

    $permissions = $request->input('permissions');

    // tambahkan permission yang dipilih ke role
    $role->permissions()->attach($permissions);

    return redirect('/data-role')->with('success', 'Data telah berhasil ditambah.');
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Role  $role
   * @return \Illuminate\Http\Response
   */
  public function show(Role $role)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Role  $role
   * @return \Illuminate\Http\Response
   */
  public function edit(Role $role, $id)
  {
    $roles = Role::findOrFail($id);
    $permissions = Permission::all();
    $selected_permissions = $roles->permissions->pluck('id')->toArray();
    return view('dashboard.manajemen-pengguna.role.edit', compact('roles', 'permissions', 'selected_permissions'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Role  $role
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Role $role, $id)
  {
    $role = Role::findOrFail($id);
    $role->update($request->only('name'));

    $permissions = $request->input('permissions', []);
    $role->permissions()->sync($permissions);
    return redirect('/data-role')->with('success', 'Data telah berhasil diperbarui.');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Role  $role
   * @return \Illuminate\Http\Response
   */
  public function destroy(Role $role, $id)
  {
    Role::destroy($id);
    return redirect('/data-role')->with('success', 'Data telah berhasil dihapus.');
  }
}