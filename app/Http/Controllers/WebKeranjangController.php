<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class WebKeranjangController extends Controller
{
    public function index()
    {
        // Get cart items for the logged-in user
        $keranjangItems = Keranjang::where('user_id', Auth::id())->with('barang')->get();

        // Pass the cart items to the view
        return view('pageweb.keranjang', ['keranjangItems' => $keranjangItems]);
    }

    public function addToCart(Request $request, $barangId)
    {
        // Validate the incoming request
        $request->validate([
            'quantity' => 'required|integer|min:1',
            'opsi_barang' => 'required|array',
        ]);

        // Find the Barang by ID
        $barang = Barang::findOrFail($barangId);

        // Calculate the total price
        $quantity = $request->input('quantity');
        $totalHarga = $quantity * $barang->harga_jual;

        // Create or update the cart entry for this user and product
        $keranjang = Keranjang::updateOrCreate(
            [
                'user_id' => Auth::id(), // Get the logged-in user ID
                'barang_id' => $barangId,
            ],
            [
                'opsi_barang' => json_encode($request->input('opsi_barang')), // Convert opsi_barang array to JSON
                'quantity' => $quantity,
                'total_harga' => $totalHarga,
            ]
        );

        // Success alert
        Alert::success('Success', 'Barang successfully added to cart!');

        return redirect()->route('keranjang.index'); // Redirect to cart page or wherever you want
    }

    public function destroy($id)
    {
        // Find the cart item by ID
        $keranjangItem = Keranjang::where('user_id', Auth::id())->where('id', $id)->first();

        // Check if the cart item exists
        if ($keranjangItem) {
            $keranjangItem->delete(); // Delete the cart item

            // Success alert
            Alert::success('Success', 'Barang berhasil dihapus dari keranjang!');
        } else {
            // Error alert
            Alert::error('Error', 'Barang tidak ditemukan di keranjang!');
        }

        return redirect()->route('keranjang.index'); // Redirect back to the cart page
    }
}
