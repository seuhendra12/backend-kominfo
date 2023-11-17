<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class TagController extends Controller
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
      $tags = Tag::orderBy('name')->filter(request(['search']))->paginate($perPage);
    } else if ($sort == 'desc') {
      $tags = Tag::orderByDesc('name')->filter(request(['search']))->paginate($perPage);
    } else {
      $tags = Tag::latest()->filter(request(['search']))->paginate($perPage);
    }

    return view('dashboard.referensi.tag.index', [
      'tags' => $tags,
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
    return view('dashboard.referensi.tag.create');
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
      'name' => 'required|unique:tags,slug',
    ], [
      'name.required' => 'Kolom nama wajib diisi',
    ]);

    $tag = new Tag([
      'name' => $request->input('name'),
      'slug' => Str::slug($request->input('name')),
    ]);

    $tag->save();

    return redirect('/tags')->with('success', 'Data telah berhasil ditambah.');
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Tag  $tag
   * @return \Illuminate\Http\Response
   */
  public function show(Tag $tag)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Tag  $tag
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $tags = Tag::findOrFail($id);
    return view('dashboard.referensi.tag.edit', compact('tags'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Tag  $tag
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    $tag = Tag::find($id);

    $request->validate([
      'name' => 'required|unique:kategoris,name',
    ]);

    $tag->name = $request->input('name');
    $tag->slug = Str::slug($request->input('name'));
    $tag->save();

    return redirect('/tags')->with('success', 'Data telah berhasil diperbarui.');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Tag  $tag
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    Tag::destroy($id);
    return redirect('/tags')->with('success', 'Data telah berhasil dihapus.');
  }
}
