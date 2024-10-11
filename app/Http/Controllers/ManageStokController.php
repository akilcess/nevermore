<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\JenisBarang;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Routing\Controller;

class ManageStokController extends Controller
{
   
    public function index()
    {
        $barangs = Barang::with('jenisBarang')->get(); // Fetch all barang with related jenisBarang
        return view('pagepegawai.manage_stok.index', compact('barangs'));
    }

   
    


    public function manage($id)
    {
        $barang = Barang::findOrFail($id);
        $jenisBarangs = JenisBarang::all(); 
        return view('pagepegawai.manage_stok.manage', compact('barang', 'jenisBarangs'));
    }

    public function update(Request $request, $id)
    {
        // Validate the input
        $request->validate([
           
            'stok' => 'required|string',
          

        ]);

        // Find the existing barang
        $barang = Barang::findOrFail($id);

        

        // Update the barang with new data
        $barang->update([
         
            'stok' => $request->stok,
         
        ]);

        // Show success message and redirect
        Alert::success('Success', 'Stok updated successfully.');
        return redirect()->route('manage_stok.index');
    }



   
}
