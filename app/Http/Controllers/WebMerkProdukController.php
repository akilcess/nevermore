<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\MerkBarang;
use Illuminate\Routing\Controller;


class WebMerkProdukController extends Controller
{
    public function getBarangByMerk($merk_barang_id)
    {
        // Retrieve the specific JenisBarang by ID
        $merkBarang = MerkBarang::findOrFail($merk_barang_id);

        // Retrieve all items (Barang) where the jenis_barang_id matches the one provided in the URL
        $barangs = Barang::where('merk_barang_id', $merk_barang_id)->get();

        // Pass the retrieved items and the jenisBarang to the view
        return view('pageweb.merkproduk', compact('barangs', 'merkBarang'));
    }
}
