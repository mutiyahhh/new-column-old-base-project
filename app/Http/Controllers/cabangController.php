<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use Illuminate\Http\Request;

class cabangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cabangs = Cabang::all();
        return view('pages.cabang.index', compact('cabangs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.cabang.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'cabang' => 'required|string'
        ]);

        $data = $request->all();
        $cabang = Cabang::create($data);

        if ($cabang) {
            toast('Data berhasil ditambah', 'success');
        } else {
            toast('Data Gagal Ditambahkan', 'error');
        }
        return redirect()->route('cabang.index');

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
        $cabang = Cabang::findOrFail($id);
        return view('pages.cabang.edit', compact('cabang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'cabang' => 'required|string'
        ]);

        $data = $request->all();
        $cabang = Cabang::findOrFail($id);
        $cabang->update($data);

        if ($data) {
            toast('Data berhasil diupdate', 'success');
        } else {
            toast('Data gagal diupdate', 'error');
        }
        return redirect()->route('cabang.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cabang = Cabang::findOrFail($id);
        $cabang->delete();
        if ($cabang) {
            toast('Data berhasil dihapus', 'success');
        } else {
            toast('Data gagal dihapus', 'error');
        }
        return redirect()->route('cabang.index');
    }
}
