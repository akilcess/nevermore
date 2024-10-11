<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\JenisBarang;
use App\Models\MerkBarang;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Routing\Controller;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barangs = Barang::with('jenisBarang','merkBarang')->get(); // Fetch all barang with related jenisBarang
        return view('pageadmin.master_barang.index', compact('barangs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jenisBarangs = JenisBarang::all(); // Fetch all jenis barangs for select option
        $merkBarangs = MerkBarang::all(); // Fetch all MerkBarang barangs for select option
        return view('pageadmin.master_barang.create', compact('jenisBarangs','merkBarangs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input termasuk multiple image dan opsi/sub opsi
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'jenis_barang_id' => 'required',
            'merk_barang_id' => 'required',
            'harga_modal' => 'required|integer',
            'harga_jual' => 'required|integer',
            'gambar.*' => 'image|mimes:jpeg,png,jpg,gif', // Validasi gambar
            'opsi' => 'required|array', // Validasi opsi sebagai array
            'opsi.*' => 'string|max:255', // Validasi setiap opsi
            'subopsi.*' => 'array', // Validasi subopsi sebagai array
            'subopsi.*.*' => 'string|max:255', // Validasi setiap subopsi
            'stok' => 'required|string',
            'berat' => 'required|string',

        ]);

        // Handle multiple image uploads
        $gambarPaths = [];
        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('uploads/barang'), $imageName);
                $gambarPaths[] = 'uploads/barang/' . $imageName; // Simpan path gambar
            }
        }

        // Gabungkan opsi dan sub opsi
        $opsiBarang = [];
        foreach ($request->opsi as $index => $opsi) {
            $opsiBarang[] = [
                'opsi' => $opsi,
                'subopsi' => $request->subopsi[$index] ?? [], // Ambil sub opsi yang sesuai dengan indeks opsi
            ];
        }

        // Simpan data barang
        Barang::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'jenis_barang_id' => $request->jenis_barang_id,
            'merk_barang_id' => $request->merk_barang_id,
            'harga_modal' => $request->harga_modal,
            'harga_jual' => $request->harga_jual,
            'gambar' => $gambarPaths, // Simpan path gambar sebagai array
            'opsi_barang' => $opsiBarang, // Simpan opsi dan sub opsi sebagai array
            'stok' => $request->stok, // Simpan opsi dan sub opsi sebagai array
            'berat' => $request->berat,
        ]);

        // Tampilkan notifikasi sukses
        Alert::success('Success', 'Barang created successfully.');
        return redirect()->route('barang.index');
    }



    public function edit($id)
    {
        // Find the barang by ID
        $barang = Barang::findOrFail($id);
        $jenisBarangs = JenisBarang::all(); // Assuming you have a model for Jenis Barang
        $merkBarangs = MerkBarang::all(); // Fetch all MerkBarang barangs for select option


        // Pass the existing data to the view
        return view('pageadmin.master_barang.edit', compact('barang', 'jenisBarangs','merkBarangs'));
    }

    public function update(Request $request, $id)
    {
        // Validate the input
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'jenis_barang_id' => 'required',
            'merk_barang_id' => 'required',
            'harga_modal' => 'required|integer',
            'harga_modal' => 'required|integer',
            'gambar.*' => 'image|mimes:jpeg,png,jpg,gif',
            'opsi' => 'required|array',
            'opsi.*' => 'string|max:255',
            'subopsi.*' => 'array',
            'subopsi.*.*' => 'string|max:255',
            'stok' => 'required|string',
            'berat' => 'required|string',

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
        $opsiBarang = [];
        foreach ($request->opsi as $index => $opsi) {
            $opsiBarang[] = [
                'opsi' => $opsi,
                'subopsi' => $request->subopsi[$index] ?? [],
            ];
        }

        // Update the barang with new data
        $barang->update([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'jenis_barang_id' => $request->jenis_barang_id,
            'merk_barang_id' => $request->merk_barang_id,
            'harga_modal' => $request->harga_modal,
            'harga_jual' => $request->harga_jual,
            'gambar' => $gambarPaths,
            'opsi_barang' => $opsiBarang,
            'stok' => $request->stok,
            'berat' => $request->berat,
        ]);

        // Show success message and redirect
        Alert::success('Success', 'Barang updated successfully.');
        return redirect()->route('barang.index');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);

        // Delete associated images
        foreach ($barang->gambar as $gambar) {
            if (file_exists(public_path($gambar))) {
                unlink(public_path($gambar));
            }
        }

        $barang->delete();

        Alert::success('Deleted', 'Barang and associated images deleted successfully.');
        return redirect()->route('barang.index');
    }
}
