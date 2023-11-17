<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use App\Models\User;
use App\Models\Role;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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
      $users = User::with(['loginHistories' => function ($query) {
        $query->latest();
      }])->orderBy('name')->filter(request(['search']))->paginate($perPage);
      $role = Role::all();
    } else if ($sort == 'desc') {
      $users = User::with(['loginHistories' => function ($query) {
        $query->latest();
      }])->orderByDesc('name')->filter(request(['search']))->paginate($perPage);
      $role = Role::all();
    } else {
      $users = User::with(['loginHistories' => function ($query) {
        $query->latest();
      }])->filter(request(['search']))->paginate($perPage);
      $role = Role::all();
    }

    return view('dashboard.manajemen-pengguna.pengguna.index', [
      'users' => $users,
      'sort' => $sort,
      'roles' => $role,
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
    return view('dashboard.manajemen-pengguna.pengguna.create', [
      'roles' => Role::all()
    ]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request, User $user)
  {
    $validatedData = $request->validate([
      'name' => ['required', 'string', 'max:255'],
      'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
      'level_akses' => ['required'],
      'satuan_kerja' => ['nullable'],
      'password' => [
        'required',
        'string',
        Password::min(8)->mixedCase()->letters()->numbers()->symbols(),
        'confirmed'
      ],
      'is_active' => 'nullable'
    ]);

    $validatedData['password'] = Hash::make($validatedData['password']);
    $validatedData['is_active'] = $request->input('is_active', 0);

    $user = User::create($validatedData);

    $roles = $request->input('roles');

    $user->assignRole($roles);

    return redirect('/data-pengguna')->with('success', 'Data telah berhasil ditambah.');
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
    //
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
    $validatedData = $request->validate([
      'is_active' => 'nullable'
    ]);

    $validatedData['is_active'] = $request->input('is_active', 0);

    User::where('id', $id)->update($validatedData);
    return redirect('/data-pengguna');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    //
  }
}
