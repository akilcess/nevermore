<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use Illuminate\Routing\Controller;


class WebIndexController extends Controller
{
    public function index()
    {
        $barangs = Barang::with('jenisBarang','merkBarang')->get(); // Fetch all barang with related jenisBarang
        return view('pageweb.index', compact('barangs'));
    }
}
