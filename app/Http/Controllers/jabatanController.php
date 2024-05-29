<?php

namespace App\Http\Controllers;

use App\Models\Level;
use Illuminate\Http\Request;

class jabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jabatans = Level::all();
        return view('pages.jabatan.index', compact('jabatans'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.jabatan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'level' => 'required|string'
        ]);

        $data = $request->all();
        $jabatan = Level::create($data);

        if ($jabatan) {
            toast('Data berhasil ditambah', 'success');
        } else {
            toast('Data Gagal Ditambahkan', 'error');
        }
        return redirect()->route('jabatan.index');
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
        $jabatan = Level::findOrFail($id);
        return view('pages.jabatan.edit', compact('jabatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'level' => 'required|string'
        ]);

        $data = $request->all();
        $jabatan = Level::findOrFail($id);
        $jabatan->update($data);

        if ($data) {
            toast('Data berhasil diupdate', 'success');
        } else {
            toast('Data gagal diupdate', 'error');
        }
        return redirect()->route('jabatan.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jabatan = Level::findOrFail($id);
        $jabatan->delete();
        if ($jabatan) {
            toast('Data berhasil dihapus', 'success');
        } else {
            toast('Data gagal dihapus', 'error');
        }
        return redirect()->route('jabatan.index');
    }
}
