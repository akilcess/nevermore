<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisBarang;
use Illuminate\Routing\Controller;


class WebNavbarHandleController extends Controller
{
    public function index()
    {
        $jenis = JenisBarang::all();
        return view('template-web.navbar', compact('jenis'));
    }
}
