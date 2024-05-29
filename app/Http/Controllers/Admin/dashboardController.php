<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class dashboardController extends Controller
{
    public function index()
    {
        return view('pages.dashboard');
    }

    public function error()
    {
        return view('error.401');
    }



}
