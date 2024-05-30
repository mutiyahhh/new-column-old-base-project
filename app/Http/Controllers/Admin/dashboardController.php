<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kpi;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class dashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->level_id == 1) {
            $kpis = Kpi::all();
        } elseif ($user->level_id == 2) {
            $kpis = Kpi::where('level_id', 2)->get();
        } elseif ($user->level_id == 3) {
            $kpis = Kpi::where('level_id', 3)->get();
        } elseif ($user->level_id == 4) {
            $kpis = Kpi::where('level_id', 4)->get();
        } elseif ($user->level_id == 5) {
            $kpis = Kpi::where('level_id', 5)->get();
        }

        return view('pages.dashboard', compact('kpis'));
    }

    public function error()
    {
        return view('error.401');
    }



}
