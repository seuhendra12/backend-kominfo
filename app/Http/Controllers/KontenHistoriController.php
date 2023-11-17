<?php

namespace App\Http\Controllers;

use App\Models\Konten;
use App\Models\Konten_histori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class KontenHistoriController extends Controller
{
    public function index(Request $request)
    {
        Artisan::call('cache:clear');

        $sort = $request->query('sort');
        $perPage = $request->query('perPage', 10);

        if ($sort == 'asc') {
            $konten_historis = Konten_histori::orderBy('name')->filter(request(['search']))->paginate($perPage);
        } else if ($sort == 'desc') {
            $konten_historis = Konten_histori::orderByDesc('name')->filter(request(['search']))->paginate($perPage);
        } else {
            $konten_historis = Konten_histori::with(['konten' => function ($query) { $query->withTrashed(); }])->latest()->filter(request(['search']))->paginate($perPage);
        }

        return view('dashboard.manajemen-konten.konten.konten-histori.index', [
            'konten_historis' => $konten_historis,
            'sort' => $sort,
            'perPage' => $perPage
        ]);
    }

    public function show($id)
    {
        $konten_historis = Konten_histori::with(['konten' => function ($query) { $query->withTrashed(); }])->findOrFail($id);
        return view('dashboard.manajemen-konten.konten.konten-histori.show', [
            'konten_historis' => $konten_historis,
        ]);
    }

    public function restore($id)
    {
        $data = Konten::withTrashed()->findOrFail($id);

        if ($data) {
            $data->restore();
            return redirect('/konten')->with('success', 'Data berhasil dipulihkan.');
        } else {
            return redirect('/konten')->with('error', 'Data tidak tersedia.');
        }
    }
}
