<?php

namespace App\Http\Controllers;

use App\Models\Kpi;
use App\Models\Level;
use Illuminate\Http\Request;

class kpiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kpis = Kpi::with('Level')->get();
        return view('pages.kpi.index', compact('kpis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $levels = Level::all();
        return view('pages.kpi.create', compact('levels'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_kpi' => ['required', 'string', 'max:255'],
            'p_measure' => ['required', 'string', 'max:255'],
            'level_id' => ['required'],

        ]);

        $data = [
            'name_kpi' => $request->name_kpi,
            'p_measure' => $request->p_measure,
            'level_id' => $request->level_id,
        ];

        Kpi::create($data);

        if ($data) {
            toast('Data berhasil ditambah', 'success');
        } else {
            toast('Data Gagal Ditambahkan', 'error');
        }
        return redirect()->route('kpi.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $levels = Level::all();
        $kpi = Kpi::with('level')->findOrFail($id);
        return view('pages.kpi.edit', compact('levels', 'kpi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name_kpi' => ['required', 'string', 'max:255'],
            'p_measure' => ['required', 'string', 'max:255'],
            'level_id' => ['required'],

        ]);

        $kpi = Kpi::findOrFail($id);
        $data = $request->all();

        $kpi->update($data);

        if ($data) {
            toast('Data berhasil diupdate', 'success');
        } else {
            toast('Data Gagal Diupdate', 'error');
        }
        return redirect()->route('kpi.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kpi = Kpi::findOrFail($id);
        $kpi->delete();
        if ($kpi) {
            toast('Data berhasil dihapus', 'success');
        } else {
            toast('Data Gagal Dihapus', 'error');
        }
        return redirect()->route('kpi.index');

    }
}
