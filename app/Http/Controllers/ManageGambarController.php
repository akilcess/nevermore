<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\JenisBarang;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Routing\Controller;

class ManageGambarController extends Controller
{
   
    public function index()
    {
        $barangs = Barang::with('jenisBarang')->get(); // Fetch all barang with related jenisBarang
        return view('pagepegawai.manage_gambar.index', compact('barangs'));
    }

   
    


    public function manage($id)
    {
        $barang = Barang::findOrFail($id);
        $jenisBarangs = JenisBarang::all(); 
        return view('pagepegawai.manage_gambar.manage', compact('barang', 'jenisBarangs'));
    }

    public function update(Request $request, $id)
    {
        // Validate the input
        $request->validate([
           
            'gambar.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
          

        ]);

        // Find the existing barang
        $barang = Barang::findOrFail($id);

        // Handle image uploads (optional)
        $gambarPaths = $barang->gambar; // Retrieve existing images
        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('uploads/barang'), $imageName);
                $gambarPaths[] = 'uploads/barang/' . $imageName; // Add new images to the array
            }
        }

        // Prepare opsi and sub opsi
        

        // Update the barang with new data
        $barang->update([
         
            'gambar' => $gambarPaths,
         
        ]);

        // Show success message and redirect
        Alert::success('Success', 'Image updated successfully.');
        return redirect()->route('manage_gambar.index');
    }



   
}
