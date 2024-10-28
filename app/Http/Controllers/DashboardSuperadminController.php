<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\RegisterUser;
use App\Models\MasterPegawai;
use Illuminate\Routing\Controller;

class DashboardSuperadminController extends Controller
{
    public function index()
    {
        // Count the number of items, registered users, and employees
        $jumlahBarang = Barang::count();
        $jumlahRegisterUser = RegisterUser::count();
        $jumlahPegawai = MasterPegawai::count();

        return view('pageadmin.dashboard.index', compact('jumlahBarang', 'jumlahRegisterUser', 'jumlahPegawai'));
    }
}
