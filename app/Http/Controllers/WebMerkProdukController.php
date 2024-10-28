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
        // Retrieve the specific MerkBarang by ID
        $merkBarang = MerkBarang::findOrFail($merk_barang_id);

        // Retrieve all items (Barang) where the merk_barang_id matches the provided ID, in random order
        $barangs = Barang::where('merk_barang_id', $merk_barang_id)->inRandomOrder()->get();

        // Pass the retrieved items and the merkBarang to the view
        return view('pageweb.merkproduk', compact('barangs', 'merkBarang'));
    }
}
