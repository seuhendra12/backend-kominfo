<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\UnitKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AgendaController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $sort = $request->query('sort');
    $perPage = $request->query('perPage', 10);

    if ($request->ajax()) {
      $start = $request->input('start', '');
      $end = $request->input('end', '');
      $events = Agenda::dateRange($start, $end)
        ->with('unitKerja')
        ->get(['id', 'judul', 'tanggal_mulai', 'tanggal_selesai', 'unitKerja_id','deskripsi','gambar','lokasi','tautan','surel'])
        ->map(function ($event) {
          $event->title = $event->judul;
          $event->description = $event->deskripsi;
          $event->start = Carbon::parse($event->tanggal_mulai)->toIso8601String();
          $event->end = Carbon::parse($event->tanggal_selesai)->toIso8601String();
          $event->backgroundColor = $event->unitKerja->label_warna;
          $event->gambar = asset('media/gambar/' . $event->gambar);
          $event->location = $event->lokasi;
          $event->link = $event->tautan;
          $event->email = $event->surel;
          return $event;
        });

      return response()->json($events);
    }


    $agendas = Agenda::latest()->filter(request(['search']));

    if ($sort == 'asc') {
      $agendas = $agendas->orderBy('judul');
    } elseif ($sort == 'desc') {
      $agendas = $agendas->orderByDesc('judul');
    }

    $agendas = $agendas->paginate($perPage);
    $unitKerjas = UnitKerja::latest()->paginate($perPage);

    return view('dashboard.manajemen-konten.agenda.index', [
      'agendas' => $agendas,
      'sort' => $sort,
      'perPage' => $perPage,
      'unitKerjas' => $unitKerjas
    ]);
  }



  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $unitKerjas = UnitKerja::all();
    return view('dashboard.manajemen-konten.agenda.create', [
      'unitKerjas' => $unitKerjas
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
      'slug' => 'nullable',
      'unitKerja' => 'required',
      'tanggal_mulai' => 'required',
      'tanggal_selesai' => 'required',
      'lokasi' => 'required',
      'deskripsi' => 'nullable',
      'tautan' => 'nullable',
      'email' => 'nullable',
      'penulis' => 'required',
      'status' => 'required',
      'gambar' => 'required|image|mimes:jpeg,png,jpg|max:1024',
    ]);

    $data = new Agenda();
    $data->judul = $request->judul;
    $data->slug = $request->filled('slug') ? $request->slug : Str::slug($request->judul);
    $data->unitKerja_id = $request->unitKerja;
    $data->tanggal_mulai = $request->tanggal_mulai;
    $data->tanggal_selesai = $request->tanggal_selesai;
    $data->lokasi = $request->lokasi;
    $data->deskripsi = $request->deskripsi;
    $data->tautan = $request->tautan;
    $data->surel = $request->surel;
    $data->penulis = $request->penulis;
    $data->status = $request->status;

    if ($request->hasFile('gambar')) {
      $gambar = $request->file('gambar');
      $image_name = time() . '.' . $gambar->getClientOriginalExtension();
      $gambar->move(public_path('media/gambar'), $image_name);
      $data->gambar = $image_name;
    }

    $data->save();

    return redirect('/agenda')->with('success', 'Data telah berhasil ditambah.');
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Agenda  $agenda
   * @return \Illuminate\Http\Response
   */
  public function show(Agenda $agenda)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Agenda  $agenda
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $agenda = Agenda::findOrFail($id);
    $unitKerjas = UnitKerja::all();
    return view('dashboard.manajemen-konten.agenda.edit', [
      'agendas' => $agenda,
      'unitKerjas' => $unitKerjas
    ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Agenda  $agenda
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    $data = Agenda::findOrFail($id);

    $request->validate([
      'judul' => 'required',
      'slug' => 'nullable',
      'unitKerja' => 'required',
      'tanggal_mulai' => 'required',
      'tanggal_selesai' => 'required',
      'lokasi' => 'required',
      'deskripsi' => 'nullable',
      'tautan' => 'nullable',
      'email' => 'nullable',
      'penulis' => 'required',
      'status' => 'required',
      'gambar' => 'image|mimes:jpeg,png,jpg|max:1024',
    ]);

    $data->judul = $request->judul;
    $data->slug = $request->filled('slug') ? $request->slug : Str::slug($request->judul);
    $data->unitKerja_id = $request->unitKerja;
    $data->tanggal_mulai = $request->tanggal_mulai;
    $data->tanggal_selesai = $request->tanggal_selesai;
    $data->lokasi = $request->lokasi;
    $data->deskripsi = $request->deskripsi;
    $data->tautan = $request->tautan;
    $data->surel = $request->surel;
    $data->penulis = $request->penulis;
    $data->status = $request->status;

    if ($request->hasFile('gambar')) {
      $gambar = $request->file('gambar');
      $image_name = time() . '.' . $gambar->getClientOriginalExtension();
      $gambar->move(public_path('media/gambar'), $image_name);
      $data->gambar = $image_name;
    }

    $data->save();

    return redirect('/agenda')->with('success', 'Data telah berhasil diubah.');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Agenda  $agenda
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $agenda = Agenda::findOrFail($id);
    $agenda->delete();

    return redirect('/agenda')->with('success', 'Data telah berhasil dihapus.');
  }
}
