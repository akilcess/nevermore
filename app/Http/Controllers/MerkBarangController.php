<?php

namespace App\Http\Controllers;

use App\Models\MerkBarang;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Routing\Controller;

class MerkBarangController extends Controller
{
    // Display list of merk
    public function index()
    {
        $merk = MerkBarang::all();
        return view('pageadmin.master_merkbarang.index', compact('merk'));
    }

    // Show form for creating new merk
    public function create()
    {
        return view('pageadmin.master_merkbarang.create');
    }

    // Store newly created merk
    // Store newly created merk
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'logo' => 'image|mimes:jpeg,png,jpg,gif', // Validasi logo
            'deskripsi' => 'required|string',
        ]);

        $logoPath = null;

        // Jika ada file logo yang diunggah
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logoName = time() . '_' . $logo->getClientOriginalName(); // Nama file unik
            $logoPath = $logo->move(public_path('uploads/merk'), $logoName); // Simpan di direktori public/uploads/merk
            $logoPath = 'uploads/merk/' . $logoName; // Simpan path untuk disimpan di database
        }

        // Create merk
        MerkBarang::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'logo' => $logoPath, // Simpan path logo
        ]);

        Alert::success('Success', 'Merk Barang successfully created!');
        return redirect()->route('merk.index');
    }

    // Update merk



    // Show form for editing merk
    public function edit($id)
    {
        $merk = MerkBarang::findOrFail($id);
        return view('pageadmin.master_merkbarang.edit', compact('merk'));
    }

    // Update merk
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'logo' => 'image|mimes:jpeg,png,jpg,gif', // Validasi logo
            'deskripsi' => 'required|string',
        ]);

        $merk = MerkBarang::findOrFail($id);

        // Simpan logo lama
        $logoPath = $merk->logo;

        // Jika ada file logo baru yang diunggah
        if ($request->hasFile('logo')) {
            // Hapus logo lama jika ada
            if ($logoPath && file_exists(public_path($logoPath))) {
                unlink(public_path($logoPath)); // Hapus file dari direktori
            }

            // Upload logo baru
            $logo = $request->file('logo');
            $logoName = time() . '_' . $logo->getClientOriginalName();
            $logo->move(public_path('uploads/merk'), $logoName);
            $logoPath = 'uploads/merk/' . $logoName; // Simpan path logo baru
        }

        // Update merk
        $merk->update([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'logo' => $logoPath, // Update path logo
        ]);

        Alert::success('Success', 'Merk Barang successfully updated!');
        return redirect()->route('merk.index');
    }

    // Delete merk
    public function destroy($id)
    {
        $merk = MerkBarang::findOrFail($id);

        // Check if the logo exists and delete the file
        if ($merk->logo && file_exists(public_path($merk->logo))) {
            unlink(public_path($merk->logo)); // Delete the logo file from the server
        }

        // Delete the merk record
        $merk->delete();

        Alert::success('Deleted', 'Merk Barang successfully deleted!');
        return redirect()->route('merk.index');
    }
}
