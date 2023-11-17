<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use App\Models\Kategori;
use App\Models\Konten;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class KontenController extends Controller
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
    $contents = Konten::query();

    if ($sort == 'asc') {
      $filters = $request->only(['year', 'category', 'status', 'from_date', 'to_date']);
      if (!empty($filters)) {
        $contents->filter($filters);
      }
      $kontens = $contents->orderBy('judul')->filter(request(['search']))->paginate($perPage);
      $kategoris = Kategori::all();
    } else if ($sort == 'desc') {
      $filters = $request->only(['year', 'category', 'status', 'from_date', 'to_date']);
      if (!empty($filters)) {
        $contents->filter($filters);
      }
      $kontens = $contents->orderByDesc('judul')->filter(request(['search']))->paginate($perPage);
      $kategoris = Kategori::all();
    } else {
      $filters = $request->only(['year', 'category', 'status', 'from_date', 'to_date']);
      if (!empty($filters)) {
        $contents->filter($filters);
      }
      $kontens = $contents->latest()->filter(request(['search']))->paginate($perPage);
      $kategoris = Kategori::all();
    }

    return view('dashboard.manajemen-konten.konten.index', [
      'kontens' => $kontens,
      'sort' => $sort,
      'perPage' => $perPage,
      'kategoris' => $kategoris
    ]);
  }


  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $galeris = Galeri::all();
    $kategoris = Kategori::all();
    return view('dashboard.manajemen-konten.konten.create', [
      'galeris' => $galeris,
      'kategoris' => $kategoris
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
      'judul' => 'required',
      'judul_eng' => 'nullable',
      'slug' => 'nullable',
      'slug_eng' => 'nullable',
      'kutipan' => 'nullable',
      'kutipan_eng' => 'nullable',
      'isi_konten' => 'required',
      'isi_konten_eng' => 'nullable',
      'galeri' => 'required',
      'files.*' => 'required|mimes:jpeg,jpg,png,pdf,zip,rar|max:5000',
      'penulis' => 'required',
      'kategori' => 'required',
      'tag' => 'nullable',
      'status' => 'required',
      'tanggal_terbit' => 'required',
      'jam_terbit' => 'required',
      'gambar_cover' => 'required|image|mimes:jpeg,png,jpg|max:1024',
      'gambar_slider' => 'required|image|mimes:jpeg,png,jpg|max:1024',
      'featured' => 'nullable',
      'featured_eng' => 'nullable',
      'sticky' => 'nullable',
      'sticky_eng' => 'nullable',
      'is_gpr' => 'nullable'
    ]);

    $data = new Konten;
    $data->judul = $request->judul;
    $data->judul_eng = $request->judul_eng;
    $data->slug = $request->filled('slug') ? $request->slug : Str::slug($request->judul);
    $data->slug_eng = $request->filled('slug_eng') ? $request->slug_eng : Str::slug($request->judul_eng);
    $data->kutipan = $request->kutipan;
    $data->kutipan_eng = $request->kutipan_eng;
    $data->isi_konten = $request->isi_konten;
    $data->isi_konten_eng = $request->isi_konten_eng;
    $data->galeri_id = $request->galeri;
    $data->penulis = $request->penulis;
    $data->kategori_id = $request->kategori;
    $data->tag = $request->tag;
    $data->status = $request->status;

    $tanggal_terbit = date('Y-m-d');
    $jam_terbit = $request->jam_terbit;
    $datetime_terbit = "$tanggal_terbit $jam_terbit:00";
    $data->tanggal_terbit = $tanggal_terbit;
    $data->jam_terbit = $datetime_terbit;

    $data->featured = $request->input('featured', 0);
    $data->featured_eng = $request->input('featured_eng', 0);
    $data->sticky = $request->input('sticky', 0);
    $data->sticky_eng = $request->input('sticky_eng', 0);
    $data->is_gpr = $request->input('is_gpr', 0);

    if ($request->hasFile('files')) {
      $files = [];
      foreach ($request->file('files') as $file) {
        $file_name = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('media/lampiran'), $file_name);
        $files[] = $file_name;
      }
      $data->lampiran = json_encode($files);
    }

    if ($request->hasFile('gambar_cover')) {
      $gambar_cover = $request->file('gambar_cover');
      $image_name = time() . '.' . $gambar_cover->getClientOriginalExtension();
      $gambar_cover->move(public_path('media/gambar_cover'), $image_name);
      $data->gambar_cover = $image_name;
    }

    if ($request->hasFile('gambar_slider')) {
      $gambar_slider = $request->file('gambar_slider');
      $image_name = time() . '.' . $gambar_slider->getClientOriginalExtension();
      $gambar_slider->move(public_path('media/gambar_slider'), $image_name);
      $data->gambar_slider = $image_name;
    }

    $data->save();

    return redirect('/konten')->with('success', 'Data telah berhasil ditambah.');
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Konten  $konten
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $kontens = Konten::findOrFail($id);
    return view('dashboard.manajemen-konten.konten.show', [
      'kontens' => $kontens,
    ]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Konten  $konten
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $kontens = Konten::findOrFail($id);
    $galeris = Galeri::all();
    $kategoris = Kategori::all();
    $files = json_decode($kontens->lampiran, true);
    return view('dashboard.manajemen-konten.konten.edit', [
      'kontens' => $kontens,
      'galeris' => $galeris,
      'kategoris' => $kategoris,
      'files' => $files
    ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Konten  $konten
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    $data = Konten::findOrFail($id);

    $request->validate([
      'judul' => 'required',
      'judul_eng' => 'nullable',
      'slug' => 'nullable',
      'slug_eng' => 'nullable',
      'kutipan' => 'nullable',
      'kutipan_eng' => 'nullable',
      'isi_konten' => 'required',
      'isi_konten_eng' => 'nullable',
      'galeri' => 'required',
      'files.*' => 'required|mimes:jpeg,jpg,png,pdf,zip,rar|max:5000',
      'penulis' => 'required',
      'kategori' => 'required',
      'tag' => 'nullable',
      'status' => 'required',
      'tanggal_terbit' => 'required',
      'jam_terbit' => 'required',
      'gambar_cover' => '|image|mimes:jpeg,png,jpg|max:1024',
      'gambar_slider' => '|image|mimes:jpeg,png,jpg|max:1024',
      'featured' => 'nullable',
      'featured_eng' => 'nullable',
      'sticky' => 'nullable',
      'sticky_eng' => 'nullable',
      'is_gpr' => 'nullable'
    ]);

    $data->judul = $request->judul;
    $data->judul_eng = $request->judul_eng;
    $data->slug = $request->filled('slug') ? $request->slug : Str::slug($request->judul);
    $data->slug_eng = $request->filled('slug_eng') ? $request->slug_eng : Str::slug($request->judul_eng);
    $data->kutipan = $request->kutipan;
    $data->kutipan_eng = $request->kutipan_eng;
    $data->isi_konten = $request->isi_konten;
    $data->isi_konten_eng = $request->isi_konten_eng;
    $data->galeri_id = $request->galeri;
    $data->penulis = $request->penulis;
    $data->kategori_id = $request->kategori;
    $data->tag = $request->tag;
    $data->status = $request->status;

    $tanggal_terbit = date('Y-m-d');
    $jam_terbit = date('H:i:s', strtotime($request->jam_terbit));
    $datetime_terbit = date('Y-m-d H:i:s', strtotime("$tanggal_terbit $jam_terbit"));
    $data->tanggal_terbit = $tanggal_terbit;
    $data->jam_terbit = $datetime_terbit;

    $data->featured = $request->input('featured', 0);
    $data->featured_eng = $request->input('featured_eng', 0);
    $data->sticky = $request->input('sticky', 0);
    $data->sticky_eng = $request->input('sticky_eng', 0);
    $data->is_gpr = $request->input('is_gpr', 0);

    if ($request->hasFile('files')) {
      $files = [];
      foreach ($request->file('files') as $file) {
        $file_name = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('media/lampiran'), $file_name);
        $files[] = $file_name;
      }
      $data->lampiran = json_encode($files);
    }

    if ($request->hasFile('gambar_cover')) {
      $gambar_cover = $request->file('gambar_cover');
      $image_name = time() . '.' . $gambar_cover->getClientOriginalExtension();
      $gambar_cover->move(public_path('media/gambar_cover'), $image_name);
      $data->gambar_cover = $image_name;
    }

    if ($request->hasFile('gambar_slider')) {
      $gambar_slider = $request->file('gambar_slider');
      $image_name = time() . '.' . $gambar_slider->getClientOriginalExtension();
      $gambar_slider->move(public_path('media/gambar_slider'), $image_name);
      $data->gambar_slider = $image_name;
    }

    $data->save();

    return redirect('/konten')->with('success', 'Data telah berhasil diubah.');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Konten  $konten
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $konten = Konten::findOrFail($id);
    $konten->delete();

    return redirect('/konten')->with('success', 'Data telah berhasil dihapus.');
  }
}
