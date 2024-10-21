<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\Checkout;
use App\Models\RegisterUser;
use App\Models\Provinsi;
use App\Models\Kabupaten;
use App\Models\Barang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;


class CheckoutController extends Controller
{
    public function index()
    {
        // Ambil pengguna yang sedang login
        $authUser = Auth::user();

        // Ambil profil pengguna dari tabel RegisterUser berdasarkan user_id
        $profileUser = RegisterUser::where('user_id', $authUser->id)->firstOrFail();

        // Ambil data provinsi dan kota pengguna berdasarkan profilnya
        $province = Provinsi::where('province_id', $profileUser->province_id)->first();
        $city = Kabupaten::where('city_id', $profileUser->city_id)->first();

        // Ambil item keranjang yang dimiliki oleh pengguna
        $keranjangItems = Keranjang::where('user_id', $authUser->id)->with('barang')->get();

        // Hitung total harga dari keranjang
        $totalHargaAwal = $keranjangItems->sum('total_harga');

        // Ambil ID kota tujuan dari profil pengguna untuk dikirimkan ke RajaOngkir
        $destination = $profileUser->city_id;

        // Panggil API RajaOngkir untuk menghitung biaya ongkos kirim
        $response = Http::withHeaders([
            'key' => '9f3168f3c9a36fcbb7350f5e56b64cca', // RajaOngkir API Key
        ])->withoutVerifying()->post('https://api.rajaongkir.com/starter/cost', [
            'origin' => 329, // Misalnya, kota asal adalah Aceh Barat (city_id: 1)
            'destination' => $destination, // Tujuan pengiriman adalah kota pengguna
            'weight' => 500, // Berat dalam gram
            'courier' => 'jne', // Jasa kurir yang digunakan
        ]);

        // Decode respons JSON
        $data = $response->json();

        // Inisialisasi variabel untuk menyimpan nilai ongkos kirim (REG)
        $regValue = 0;

        // Cek apakah respons dari API sukses dan terdapat data biaya pengiriman
        if (isset($data['rajaongkir']['results'][0]['costs'])) {
            // Ambil data service dan biaya pengiriman
            $services = $data['rajaongkir']['results'][0]['costs'];

            // Cari nilai untuk service 'REG'
            foreach ($services as $service) {
                if ($service['service'] === 'REG') {
                    $regValue = $service['cost'][0]['value']; // Ambil biaya pengiriman untuk service REG
                    break;
                }
            }
        }

        // Tambahkan reg_cost ke total harga
        $totalHarga = $totalHargaAwal + $regValue;

        // Kirim data ke view proses checkout
        return view('pageweb.proses', [
            'keranjangItems' => $keranjangItems,
            'totalHarga' => $totalHarga, // Total harga termasuk ongkos kirim
            'province' => $province,
            'city' => $city,
            'profileUser' => $profileUser,
            'reg_cost' => $regValue, // Ongkos kirim REG (jika ditemukan)
        ]);
    }





    public function checkout(Request $request)
    {
        // Validasi data (pastikan untuk validasi bukti_pembayaran dan total_harga)
        $request->validate([
            'bukti_pembayaran' => 'image|mimes:jpeg,png,jpg,gif', // Validasi bukti pembayaran
            'total_harga' => 'required', // Validasi total harga
        ]);

        // Mendapatkan item keranjang untuk user yang sedang login
        $keranjangItems = Keranjang::where('user_id', Auth::id())->with('barang')->get();

        // Inisialisasi array kosong untuk menyimpan data gabungan
        $barangData = [];

        // Loop melalui item keranjang dan kumpulkan datanya
        foreach ($keranjangItems as $item) {
            // Simpan data dalam array asosiatif dengan barang_id dan data terkait
            $barangData[] = [
                'barang_id' => $item->barang_id, // Menyimpan barang_id
                'quantity' => $item->quantity, // Menyimpan jumlah barang
                'opsi_barang' => json_decode($item->opsi_barang), // Decode opsi_barang ke dalam array PHP
            ];

            // Kurangi stok pada tabel Barang
            $barang = Barang::find($item->barang_id);
            if ($barang && $barang->stok >= $item->quantity) {
                $barang->stok -= $item->quantity;
                $barang->save();
            } else {
                return back()->with('error', 'Stok barang tidak mencukupi untuk barang: ' . $barang->nama);
            }
        }

        // Handle upload bukti pembayaran
        $buktiPembayaranPath = null;

        if ($request->hasFile('bukti_pembayaran')) {
            $logo = $request->file('bukti_pembayaran');
            $logoName = time() . '_' . $logo->getClientOriginalName(); // Nama file unik
            $buktiPembayaranPath = $logo->move(public_path('uploads/bukti_pembayaran'), $logoName); // Simpan di direktori public/uploads/bukti_pembayaran
            $buktiPembayaranPath = 'uploads/bukti_pembayaran/' . $logoName; // Simpan path untuk disimpan di database
        }

        // Simpan semua data yang dikumpulkan ke model Checkout
        Checkout::create([
            'user_id' => Auth::id(),
            'barang' => json_encode($barangData), // Simpan data sebagai JSON
            'total_harga' => $request->input('total_harga'), // Ambil total harga dari request
            'bukti_pembayaran' => $buktiPembayaranPath, // Simpan path bukti pembayaran
            'status' => 'pending', // Set status default menjadi 'pending'
        ]);

        // Hapus keranjang setelah berhasil checkout
        Keranjang::where('user_id', Auth::id())->delete();

        // Pesan sukses
        Alert::success('Success', 'Checkout completed successfully!');

        return redirect()->route('pesanansaya');
    }
}
