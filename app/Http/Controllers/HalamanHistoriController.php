<?php

namespace App\Http\Controllers;

use App\Models\Halaman;
use App\Models\HalamanHistori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class HalamanHistoriController extends Controller
{
    public function index(Request $request)
    {
        Artisan::call('cache:clear');

        $sort = $request->query('sort');
        $perPage = $request->query('perPage', 10);

        if ($sort == 'asc') {
            $halamanHistoris = HalamanHistori::orderBy('name')->filter(request(['search']))->paginate($perPage);
        } else if ($sort == 'desc') {
            $halamanHistoris = HalamanHistori::orderByDesc('name')->filter(request(['search']))->paginate($perPage);
        } else {
            $halamanHistoris = HalamanHistori::with(['halaman' => function ($query) {
                $query->withTrashed();
            }])->latest()->filter(request(['search']))->paginate($perPage);
        }

        return view('dashboard.manajemen-konten.halaman.halaman-histori.index', [
            'halamanHistoris' => $halamanHistoris,
            'sort' => $sort,
            'perPage' => $perPage
        ]);
    }

    public function show($id)
    {
        $halamanHistori = HalamanHistori::with(['halaman' => function ($query) {
            $query->withTrashed();
        }])->findOrFail($id);
        return view('dashboard.manajemen-konten.halaman.halaman-histori.show', [
            'halamanHistoris' => $halamanHistori,
        ]);
    }

    public function restore($id)
    {
        $data = Halaman::withTrashed()->findOrFail($id);

        if ($data) {
            $data->restore();
            return redirect('/halaman')->with('success', 'Data berhasil dipulihkan.');
        } else {
            return redirect('/halaman')->with('error', 'Data tidak tersedia.');
        }
    }
}
