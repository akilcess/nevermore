<?php

namespace App\Http\Controllers;

use App\Models\RequestStok;
use App\Models\Barang;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;

class RequestStokController extends Controller
{
    public function index()
    {
        $requestStok = RequestStok::with('barang.jenisBarang', 'barang.merkBarang')->get();
        return view('pagepegawai.request_stok.index', compact('requestStok'));
    }

    public function getStok($id)
    {
        $barang = Barang::findOrFail($id);
        return response()->json(['stok' => $barang->stok]);
    }

    public function create()
    {
        $barang = Barang::all();
        return view('pagepegawai.request_stok.request', compact('barang'));
    }
    public function store(Request $request)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'stok_awal' => 'required|numeric',
            'request_stok' => 'required|numeric',
        ]);

        // Create a new RequestStok entry
        $requestStok = RequestStok::create([
            'barang_id' => $request->input('barang_id'),
            'stok_awal' => $request->input('stok_awal'), // Take stok_awal from input
            'request_stok' => $request->input('request_stok'),
            'status' => 'belum dikonfirmasi', // Default status
        ]);


        // Use SweetAlert to display a success notification
        Alert::success('Success', 'Stock request created and stock updated successfully!');

        // Redirect to a specific page (e.g., back to the form or stock list)
        return redirect()->route('request_stok.index');
    }
    public function edit($id)
    {
        // Find the RequestStok by id
        $requestStok = RequestStok::findOrFail($id);
        // Get all Barang items for the dropdown
        $barang = Barang::all();

        // Pass the data to the view
        return view('pagepegawai.request_stok.edit', compact('requestStok', 'barang'));
    }

    public function update(Request $request, $id)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'stok_awal' => 'required|numeric',
            'request_stok' => 'required|numeric',
        ]);

        // Find the existing RequestStok record
        $requestStok = RequestStok::findOrFail($id);

        // Update the RequestStok data
        $requestStok->update([
            'barang_id' => $request->input('barang_id'),
            'stok_awal' => $request->input('stok_awal'),
            'request_stok' => $request->input('request_stok'),
            'status' => 'belum dikonfirmasi', // You can keep this or change based on status logic
        ]);

        // Use SweetAlert to display a success notification
        Alert::success('Success', 'Stock request updated successfully!');

        // Redirect back to the request stock list
        return redirect()->route('request_stok.index');
    }
    public function destroy($id)
    {
        $requestStok = RequestStok::findOrFail($id);
        
        $requestStok->delete();

        Alert::success('Deleted', 'Stock request successfully deleted!');
        return redirect()->route('request_stok.index');
    }
}
