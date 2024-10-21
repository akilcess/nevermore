<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class ProsesPenjualanController extends Controller
{
    // Fetch all the checkouts (for all users)
    public function index()
    {
        // Fetch checkouts with user details, province, and city
        $checkouts = Checkout::select('checkouts.*', 
                    'register_users.nama AS user_nama', 
                    'register_users.alamat AS user_alamat', 
                    'register_users.telepon AS user_telepon',
                    'provinsis.province AS province', 
                    'kabupatens.city_name AS city_name')
            ->join('register_users', 'checkouts.user_id', '=', 'register_users.user_id')
            ->leftJoin('provinsis', 'register_users.province_id', '=', 'provinsis.province_id')
            ->leftJoin('kabupatens', 'register_users.city_id', '=', 'kabupatens.city_id')
            ->get();
    
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
                    'bukti_pembayaran' => $checkout->bukti_pembayaran,
                    'user_details' => [
                        'nama' => $checkout->user_nama,
                        'alamat' => $checkout->user_alamat,
                        'telepon' => $checkout->user_telepon,
                        'province' => $checkout->province,
                        'city' => $checkout->city_name,
                    ],
                ];
            }
        }
    
        return view('pagepegawai.proses_penjualan.index', compact('checkoutData'));
    }
    


    // Function to update the status of a specific checkout to "dikirim"
    public function markAsCompleted(Request $request, $id)
    {
        // Find the checkout by its ID
        $checkout = Checkout::find($id);

        if ($checkout) {
            // Validate the no_resi input from the form
            $request->validate([
                'no_resi' => 'required|string|max:255', // Validation for no_resi
            ]);

            // Update the no_resi and status to 'dikirim'
            $checkout->no_resi = $request->input('no_resi'); // Save the 'no_resi'
            $checkout->status = 'dikirim'; // Update the status to 'dikirim'
            $checkout->save(); // Save the changes to the database

            // Show a success message using SweetAlert
            Alert::success('Success', 'Pesanan telah dikirim ke customer dengan nomor resi: ' . $checkout->no_resi);
        } else {
            // If the checkout is not found, show an error message
            Alert::error('Error', 'Pesanan tidak ditemukan.');
        }

        // Redirect back to the sales process page
        return redirect()->route('proses_penjualan');
    }

    public function dikirim()
    {
        // Fetch checkouts with user details, province, and city
        $checkouts = Checkout::select('checkouts.*', 
                    'register_users.nama AS user_nama', 
                    'register_users.alamat AS user_alamat', 
                    'register_users.telepon AS user_telepon',
                    'provinsis.province AS province', 
                    'kabupatens.city_name AS city_name')
            ->join('register_users', 'checkouts.user_id', '=', 'register_users.user_id')
            ->leftJoin('provinsis', 'register_users.province_id', '=', 'provinsis.province_id')
            ->leftJoin('kabupatens', 'register_users.city_id', '=', 'kabupatens.city_id')
            ->get();
    
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
                    'bukti_pembayaran' => $checkout->bukti_pembayaran,
                    'user_details' => [
                        'nama' => $checkout->user_nama,
                        'alamat' => $checkout->user_alamat,
                        'telepon' => $checkout->user_telepon,
                        'province' => $checkout->province,
                        'city' => $checkout->city_name,
                    ],
                ];
            }
        }
    
        return view('pagepegawai.proses_penjualan.dikirim', compact('checkoutData'));
    }

    public function selesai()
    {
        // Fetch checkouts with user details, province, and city
        $checkouts = Checkout::select('checkouts.*', 
                    'register_users.nama AS user_nama', 
                    'register_users.alamat AS user_alamat', 
                    'register_users.telepon AS user_telepon',
                    'provinsis.province AS province', 
                    'kabupatens.city_name AS city_name')
            ->join('register_users', 'checkouts.user_id', '=', 'register_users.user_id')
            ->leftJoin('provinsis', 'register_users.province_id', '=', 'provinsis.province_id')
            ->leftJoin('kabupatens', 'register_users.city_id', '=', 'kabupatens.city_id')
            ->get();
    
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
                    'bukti_pembayaran' => $checkout->bukti_pembayaran,
                    'user_details' => [
                        'nama' => $checkout->user_nama,
                        'alamat' => $checkout->user_alamat,
                        'telepon' => $checkout->user_telepon,
                        'province' => $checkout->province,
                        'city' => $checkout->city_name,
                    ],
                ];
            }
        }
    
        return view('pagepegawai.proses_penjualan.selesai', compact('checkoutData'));
    }
}
