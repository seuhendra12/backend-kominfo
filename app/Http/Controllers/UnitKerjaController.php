<?php

namespace App\Http\Controllers;

use App\Models\UnitKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class UnitKerjaController extends Controller
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
            $unitKerjas = UnitKerja::orderBy('name')->filter(request(['search']))->paginate($perPage);
        } else if ($sort == 'desc') {
            $unitKerjas = UnitKerja::orderByDesc('name')->filter(request(['search']))->paginate($perPage);
        } else {
            $unitKerjas = UnitKerja::latest()->filter(request(['search']))->paginate($perPage);
        }

        return view('dashboard.referensi.unitKerja.index', [
            'unitKerjas' => $unitKerjas,
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
        return view('dashboard.referensi.unitKerja.create');
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
            'name' => 'required',
            'label_warna' => 'required'
        ], [
            'name.required' => 'Kolom nama wajib diisi',
        ]);

        $unitKerja = new UnitKerja([
            'name' => $request->input('name'),
            'label_warna' => $request->input('label_warna')
        ]);

        $unitKerja->save();

        return redirect('/unitKerja')->with('success', 'Data telah berhasil ditambah.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UnitKerja  $unitKerja
     * @return \Illuminate\Http\Response
     */
    public function show(UnitKerja $unitKerja)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UnitKerja  $unitKerja
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $unitKerjas = UnitKerja::findOrFail($id);
        return view('dashboard.referensi.unitKerja.edit', compact('unitKerjas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UnitKerja  $unitKerja
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $unitKerja = UnitKerja::find($id);

        $request->validate([
            'name' => 'required',
            'label_warna' => 'required',
        ]);

        $unitKerja->name = $request->input('name');
        $unitKerja->label_warna = $request->input('label_warna');
        $unitKerja->save();

        return redirect('/unitKerja')->with('success', 'Data telah berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UnitKerja  $unitKerja
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $unitKerja = UnitKerja::findorFail($id);
        $unitKerja->destroy($id);
        return redirect('/unitKerja')->with('success', 'Data telah berhasil dihapus.');
    }
}
