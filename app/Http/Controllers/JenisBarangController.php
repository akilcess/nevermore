<?php

namespace App\Http\Controllers;

use App\Models\JenisBarang;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Routing\Controller;

class JenisBarangController extends Controller
{
    // Display list of pegawai
    public function index()
    {
        $jenis = JenisBarang::all();
        return view('pageadmin.master_jenisbarang.index', compact('jenis'));
    }

    // Show form for creating new pegawai
    public function create()
    {
        return view('pageadmin.master_jenisbarang.create');
    }

    // Store newly created pegawai
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
          
        ]);

       

        // Create pegawai
        JenisBarang::create([
            'nama' => $request->nama,
            
        ]);

        Alert::success('Success', 'Jenis Barang successfully created!');
        return redirect()->route('jenis.index');
    }

    // Show form for editing pegawai
    public function edit($id)
    {
        $jenis = JenisBarang::findOrFail($id);
        return view('pageadmin.master_jenisbarang.edit', compact('jenis'));
    }

    // Update pegawai
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
          
        ]);

        // Find existing pegawai and user
        $jenis = JenisBarang::findOrFail($id);

       

        // Update pegawai
        $jenis->update([
            'nama' => $request->nama,
           
        ]);

        

        Alert::success('Success', 'Jenis Barang successfully updated!');
        return redirect()->route('jenis.index');
    }

    // Delete pegawai
    public function destroy($id)
    {
        $jenis = JenisBarang::findOrFail($id);
        
        $jenis->delete();

        Alert::success('Deleted', 'Jenis Barang successfully deleted!');
        return redirect()->route('jenis.index');
    }
}
