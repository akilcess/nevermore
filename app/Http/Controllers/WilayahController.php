<?php

namespace App\Http\Controllers;

use App\Models\Provinsi;
use App\Models\Kabupaten;
use Illuminate\Support\Facades\Http;
use Illuminate\Routing\Controller;

class WilayahController extends Controller
{
    public function fetchAndStoreAll()
    {
        // Memanggil API untuk Provinsi
        $responseProvinsi = Http::withHeaders([
            'key' => '9f3168f3c9a36fcbb7350f5e56b64cca',
        ])->withoutVerifying()->get('https://api.rajaongkir.com/starter/province');

        if ($responseProvinsi->successful()) {
            $provinsiResults = $responseProvinsi->json()['rajaongkir']['results'];

            foreach ($provinsiResults as $provinsi) {
                Provinsi::updateOrCreate(
                    ['province_id' => $provinsi['province_id']],
                    ['province' => $provinsi['province']]
                );
            }
        }

        // Memanggil API untuk Kabupaten
        $responseKabupaten = Http::withHeaders([
            'key' => '9f3168f3c9a36fcbb7350f5e56b64cca',
        ])->withoutVerifying()->get('https://api.rajaongkir.com/starter/city');

        if ($responseKabupaten->successful()) {
            $kabupatenResults = $responseKabupaten->json()['rajaongkir']['results'];

            foreach ($kabupatenResults as $kabupaten) {
                Kabupaten::updateOrCreate(
                    ['city_id' => $kabupaten['city_id']],
                    [
                        'province_id' => $kabupaten['province_id'],
                        'city_name' => $kabupaten['city_name']
                    ]
                );
            }
        }

        return "Semua data Provinsi dan Kabupaten berhasil disimpan!";
    }
}