<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class KategoriController extends Controller
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
      $kategoris = Kategori::orderBy('name')->filter(request(['search']))->paginate($perPage);
    } else if ($sort == 'desc') {
      $kategoris = Kategori::orderByDesc('name')->filter(request(['search']))->paginate($perPage);
    } else {
      $kategoris = Kategori::latest()->filter(request(['search']))->paginate($perPage);
    }

    return view('dashboard.referensi.kategori.index', [
      'kategoris' => $kategoris,
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
    return view('dashboard.referensi.kategori.create');
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
      'name' => 'required|unique:kategoris,name',
    ], [
      'name.required' => 'Kolom nama wajib diisi',
    ]);

    $kategori = new Kategori([
      'name' => $request->input('name'),
      'slug' => Str::slug($request->input('name')),
    ]);

    $kategori->save();

    return redirect('/kategoris')->with('success', 'Data telah berhasil ditambah.');
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Kategori  $kategori
   * @return \Illuminate\Http\Response
   */
  public function show(Kategori $kategori)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Kategori  $kategori
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $kategoris = Kategori::findOrFail($id);
    return view('dashboard.referensi.kategori.edit', compact('kategoris'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Kategori  $kategori
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    $category = Kategori::find($id);

    $request->validate([
      'name' => 'required|unique:kategoris,name',
    ]);

    $category->name = $request->input('name');
    $category->slug = Str::slug($request->input('name'));
    $category->save();

    return redirect('/kategoris')->with('success', 'Data telah berhasil diperbarui.');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Kategori  $kategori
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    Kategori::destroy($id);
    return redirect('/kategoris')->with('success', 'Data telah berhasil dihapus.');
  }
}
