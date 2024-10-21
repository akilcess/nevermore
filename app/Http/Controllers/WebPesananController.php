<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;


class WebPesananController extends Controller
{
    // The existing index function remains unchanged
    public function index()
    {
        // Fetch all the checkouts for the logged-in user
        $checkouts = Checkout::where('user_id', Auth::id())->get();

        $checkoutData = [];

        foreach ($checkouts as $checkout) {
            $items = json_decode($checkout->barang, true);

            if (is_array($items)) {
                $groupedItems = [];

                foreach ($items as $item) {
                    $barang = Barang::find($item['barang_id']);

                    $groupedItems[] = [
                        'nama_barang' => $barang ? $barang->nama : 'Unknown',
                        'gambar_barang' => $barang ? $barang->gambar[0] : 'Unknown',
                        'quantity' => $item['quantity'],
                        'opsi_barang' => $item['opsi_barang'],
                        'harga' => $barang ? $barang->harga : 0,
                    ];
                }

                $checkoutData[] = [
                    'items' => $groupedItems,
                    'total_harga' => $checkout->total_harga,
                    'id' => $checkout->id,
                    'status' => $checkout->status,
                    'no_resi' => $checkout->no_resi,
                ];
            }
        }

        return view('pageweb.pesanansaya', compact('checkoutData'));
    }

    // Function to update the status to "selesai"
    public function markAsCompleted($id)
    {
        // Find the checkout by its ID and ensure it belongs to the authenticated user
        $checkout = Checkout::where('id', $id)->where('user_id', Auth::id())->first();

        if ($checkout) {
            // Update the status to 'selesai'
            $checkout->status = 'selesai';
            $checkout->save();

            Alert::success('Success', 'Pesanan sudah diterima customer!');
            return redirect()->route('pesanansaya');
        }
    }
}
