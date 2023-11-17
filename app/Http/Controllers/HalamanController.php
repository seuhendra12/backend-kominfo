<?php

namespace App\Http\Controllers;

use App\Models\Halaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;

class HalamanController extends Controller
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
      $halamans = Halaman::orderBy('name')->filter(request(['search']))->paginate($perPage);
    } else if ($sort == 'desc') {
      $halamans = Halaman::orderByDesc('name')->filter(request(['search']))->paginate($perPage);
    } else {
      $halamans = Halaman::latest()->filter(request(['search']))->paginate($perPage);
    }

    return view('dashboard.manajemen-konten.halaman.index', [
      'halamans' => $halamans,
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
    return view('dashboard.manajemen-konten.halaman.create');
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
      'isi_konten' => 'required',
      'penulis' => 'required',
      'tag' => 'nullable',
      'status' => 'required',
      'tanggal_terbit' => 'required',
      'jam_terbit' => 'required',
      'gambar_cover' => 'required|image|mimes:jpeg,png,jpg|max:1024',
      'files.*' => 'required|mimes:jpeg,jpg,png,pdf,zip,rar|max:5000',
    ]);

    $data = new Halaman;
    $data->judul = $request->judul;
    $data->isi_konten = $request->isi_konten;
    $data->penulis = $request->penulis;
    $data->tag = $request->tag;
    $data->status = $request->status;

    $tanggal_terbit = date('Y-m-d');
    $jam_terbit = $request->jam_terbit;
    $datetime_terbit = "$tanggal_terbit $jam_terbit:00";
    $data->tanggal_terbit = $tanggal_terbit;
    $data->jam_terbit = $datetime_terbit;

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

    $data->save();

    return redirect('/halaman')->with('success', 'Data telah berhasil ditambah.');
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Halaman  $halaman
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $halaman = Halaman::findOrFail($id);
    return view('dashboard.manajemen-konten.halaman.show', [
      'halaman' => $halaman,
    ]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Halaman  $halaman
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $halaman = Halaman::findOrFail($id);
    $files = json_decode($halaman->lampiran, true);
    return view('dashboard.manajemen-konten.halaman.edit', compact(['halaman', 'files']));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Halaman  $halaman
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    $data = Halaman::findOrFail($id);

    $request->validate([
      'judul' => 'required',
      'isi_konten' => 'required',
      'penulis' => 'required',
      'tag' => 'nullable',
      'status' => 'required',
      'tanggal_terbit' => 'required',
      'jam_terbit' => 'required',
      'gambar_cover' => 'nullable|image|mimes:jpeg,png,jpg|max:1024',
      'files.*' => 'nullable|mimes:jpeg,jpg,png,pdf,zip,rar|max:5000',
    ]);

    $data->judul = $request->judul;
    $data->isi_konten = $request->isi_konten;
    $data->penulis = $request->penulis;
    $data->tag = $request->tag;
    $data->status = $request->status;

    $tanggal_terbit = date('Y-m-d');
    $jam_terbit = date('H:i:s', strtotime($request->jam_terbit));
    $datetime_terbit = date('Y-m-d H:i:s', strtotime("$tanggal_terbit $jam_terbit"));
    $data->tanggal_terbit = $tanggal_terbit;
    $data->jam_terbit = $datetime_terbit;

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

    $data->save();

    return redirect('/halaman')->with('success', 'Data telah berhasil diperbarui.');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Halaman  $halaman
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $halaman = Halaman::findOrFail($id);
    $halaman->delete();

    return redirect('/halaman')->with('success', 'Data telah berhasil dihapus.');
  }
}
