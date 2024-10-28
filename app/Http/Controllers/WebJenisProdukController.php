<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\JenisBarang;
use Illuminate\Routing\Controller;

class WebJenisProdukController extends Controller
{
    public function getBarangByJenis($jenis_barang_id)
    {
        // Retrieve the specific JenisBarang by ID
        $jenisBarang = JenisBarang::findOrFail($jenis_barang_id);

        // Retrieve all items (Barang) where the jenis_barang_id matches the provided ID, in random order
        $barangs = Barang::where('jenis_barang_id', $jenis_barang_id)->inRandomOrder()->get();

        // Pass the retrieved items and the jenisBarang to the view
        return view('pageweb.jenisproduk', compact('barangs', 'jenisBarang'));
    }
}
