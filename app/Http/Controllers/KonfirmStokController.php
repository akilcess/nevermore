<?php

namespace App\Http\Controllers;

use App\Models\RequestStok;
use App\Models\Barang;
use App\Models\JenisBarang;
use App\Models\MerkBarang;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Routing\Controller;


class KonfirmStokController extends Controller
{

    public function index()
    {
        // Retrieve only the RequestStok entries with the status 'belum dikonfirmasi'
        $requestStok = RequestStok::with('barang')
            ->where('status', 'belum dikonfirmasi')
            ->get();

        return view('pageadmin.konfirm_request_stok.index', compact('requestStok'));
    }


    public function edit($id)
    {
        // Find the RequestStok by id
        $requestStok = RequestStok::with('barang.jenisBarang', 'barang.merkBarang')->findOrFail($id);

        // Get all Barang items for the dropdown (if needed)
        $barang = Barang::all();

        // Pass the data to the view
        return view('pageadmin.konfirm_request_stok.edit', compact('requestStok', 'barang'));
    }


    public function updateStatus(Request $request, $id)
    {
        // Find the RequestStok entry by ID
        $requestStok = RequestStok::findOrFail($id);

        // Validate the status input
        $validatedData = $request->validate([
            'status' => 'required|string',
        ]);

        // If the status is changed to 'dikonfirmasi', update the stock in the Barang table
        if ($request->input('status') == 'dikonfirmasi') {
            // Find the associated Barang entry
            $barang = Barang::findOrFail($requestStok->barang_id);

            // Add request_stok to the current stock
            $barang->stok += $requestStok->request_stok;

            // Save the updated stock in the Barang table
            $barang->save();
        }

        // Update the status in the RequestStok table
        $requestStok->update([
            'status' => $request->input('status'),
        ]);

        // Use SweetAlert to display a success notification
        Alert::success('Success', 'Status updated successfully!');

        // Redirect to the request stock list page
        return redirect()->route('konfirm_request_stok.index');
    }
}
