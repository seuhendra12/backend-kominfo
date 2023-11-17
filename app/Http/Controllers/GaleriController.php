<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class GaleriController extends Controller
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
      $galeris = Galeri::orderBy('name')->filter(request(['search']))->paginate($perPage);
    } else if ($sort == 'desc') {
      $galeris = Galeri::orderByDesc('name')->filter(request(['search']))->paginate($perPage);
    } else {
      $galeris = Galeri::latest()->filter(request(['search']))->paginate($perPage);
    }

    return view('dashboard.manajemen-konten.galeri.index', [
      'galeris' => $galeris,
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
    return view('dashboard.manajemen-konten.galeri.create');
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
      'description' => 'required'
    ], [
      'name.required' => 'Kolom nama wajib diisi',
      'description.required' => 'Kolom deskripsi wajib diisi',
    ]);

    $galeri = new Galeri([
      'name' => $request->input('name'),
      'description' => $request->input('description')
    ]);

    $galeri->save();

    return redirect('/galeri')->with('success', 'Data telah berhasil ditambah.');
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Galeri  $galeri
   * @return \Illuminate\Http\Response
   */
  public function show(Galeri $galeri)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Galeri  $galeri
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $galeri = Galeri::findOrFail($id);
    return view('dashboard.manajemen-konten.galeri.edit', compact('galeri'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Galeri  $galeri
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    $galeri = Galeri::find($id);

    $request->validate([
      'name' => 'required|unique:permissions',
      'description' => 'required'
    ]);

    $galeri->name = $request->input('name');
    $galeri->description = $request->input('description');
    $galeri->save();

    return redirect('/galeri')->with('success', 'Data telah berhasil diperbarui.');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Galeri  $galeri
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    Galeri::destroy($id);
    return redirect('/galeri')->with('success', 'Data telah berhasil dihapus.');
  }
}
