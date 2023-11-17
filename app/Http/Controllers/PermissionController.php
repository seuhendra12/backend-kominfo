<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;
use Illuminate\Support\Facades\Artisan;

class PermissionController extends Controller
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
      $permissions = Permission::orderBy('name')->filter(request(['search']))->paginate($perPage);
    } else if ($sort == 'desc') {
      $permissions = Permission::orderByDesc('name')->filter(request(['search']))->paginate($perPage);
    } else {
      $permissions = Permission::latest()->filter(request(['search']))->paginate($perPage);
    }

    return view('dashboard.manajemen-pengguna.permission.index', [
      'permissions' => $permissions,
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
    return view('dashboard.manajemen-pengguna.permission.create');
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
      'name' => 'required|unique:permissions',
    ], [
      'name.required' => 'Kolom nama wajib diisi',
    ]);

    $permission = new Permission();
    $permission->name = $request->input('name');
    $permission->guard_name = 'web';
    $permission->save();

    return redirect('/data-permission')->with('success', 'Data telah berhasil ditambah.');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $permissions = Permission::findOrFail($id);
    return view('dashboard.manajemen-pengguna.permission.edit', compact('permissions'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    $permission = Permission::findOrFail($id);
    $permission->update($request->only('name'));

    return redirect('/data-permission')->with('success', 'Data telah berhasil diperbarui.');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    Permission::destroy($id);
    return redirect('/data-permission')->with('success', 'Data telah berhasil dihapus.');
  }
}
