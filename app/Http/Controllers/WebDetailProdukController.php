<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\JenisBarang;
use App\Models\MerkBarang;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Routing\Controller;

class WebDetailProdukController extends Controller
{
    public function index($id)
    {
        // Find the barang by ID
        $barang = Barang::findOrFail($id);
        $jenisBarangs = JenisBarang::all(); // Assuming you have a model for Jenis Barang
        $merkBarangs = MerkBarang::all(); // Fetch all MerkBarang barangs for select option


        // Pass the existing data to the view
        return view('pageweb.detail', compact('barang', 'jenisBarangs','merkBarangs'));
    }
}