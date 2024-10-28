<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Checkout;
use App\Models\Barang;

class HandleLaporanController extends Controller
{
    public function allpenjualan()
    {
        // Fetch checkouts with user details, province, and city
        $allPesanan = Checkout::select(
            'checkouts.*',
            'register_users.nama AS user_nama',
            'register_users.alamat AS user_alamat',
            'register_users.telepon AS user_telepon',
            'provinsis.province AS province',
            'kabupatens.city_name AS city_name'
        )
            ->join('register_users', 'checkouts.user_id', '=', 'register_users.user_id')
            ->leftJoin('provinsis', 'register_users.province_id', '=', 'provinsis.province_id')
            ->leftJoin('kabupatens', 'register_users.city_id', '=', 'kabupatens.city_id')
            ->where('status', 'selesai')
            ->get();

        $allPesananData = [];

        foreach ($allPesanan as $pesanan) {  // Changed variable name to avoid conflict
            $items = json_decode($pesanan->barang, true);  // Decode JSON to array

            if (is_array($items)) {
                $groupedItems = [];

                foreach ($items as $item) {
                    $barang = Barang::find($item['barang_id']);  // Fetch the barang record

                    $groupedItems[] = [
                        'nama_barang' => $barang ? $barang->nama : 'Unknown',
                        'gambar_barang' => $barang && isset($barang->gambar[0]) ? $barang->gambar[0] : 'Unknown',
                        'quantity' => $item['quantity'],
                        'opsi_barang' => $item['opsi_barang'],
                        'harga' => $barang ? $barang->harga : 0,
                    ];
                }

                $allPesananData[] = [
                    'items' => $groupedItems,
                    'total_harga' => $pesanan->total_harga,
                    'id' => $pesanan->id,
                    'status' => $pesanan->status,
                    'bukti_pembayaran' => $pesanan->bukti_pembayaran,
                    'user_details' => [
                        'nama' => $pesanan->user_nama,
                        'alamat' => $pesanan->user_alamat,
                        'telepon' => $pesanan->user_telepon,
                        'province' => $pesanan->province,
                        'city' => $pesanan->city_name,
                    ],
                ];
            }
        }

        return view('pageadmin.laporan.allpesanan', compact('allPesananData'));
    }

    public function allstok()
    {
        $barangs = Barang::with('jenisBarang', 'merkBarang')->get(); // Fetch all barang with related jenisBarang
        return view('pageadmin.laporan.stok', compact('barangs'));
    }
    public function palingseringdibeli()
    {
        $barangs = Barang::with('jenisBarang', 'merkBarang') // Fetch related data
            ->get()
            ->map(function ($barang) {
                $totalSold = Checkout::where('status', 'selesai')
                    ->get()
                    ->sum(function ($checkout) use ($barang) {
                        $items = json_decode($checkout->barang, true);
                        $quantity = 0;

                        foreach ($items as $item) {
                            if ($item['barang_id'] == $barang->id) {
                                $quantity += $item['quantity'];
                            }
                        }

                        return $quantity;
                    });

                $barang->total_sold = $totalSold;
                return $barang;
            })
            ->sortByDesc('total_sold'); // Sort by total sold quantity

        return view('pageadmin.laporan.palingseringdibeli', compact('barangs'));
    }
}
