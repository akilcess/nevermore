<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use Illuminate\Routing\Controller;

class WebIndexController extends Controller
{
    public function index(Request $request)
    {
        // Base query with relations
        $query = Barang::with('jenisBarang', 'merkBarang');

        // Check for search parameter
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('nama', 'like', '%' . $search . '%')
                ->orWhereHas('jenisBarang', function ($q) use ($search) {
                    $q->where('nama', 'like', '%' . $search . '%');
                })
                ->orWhereHas('merkBarang', function ($q) use ($search) {
                    $q->where('nama', 'like', '%' . $search . '%');
                });
        }

        // Randomize the order of the results
        $barangs = $query->inRandomOrder()->get();

        return view('pageweb.index', compact('barangs'));
    }
}
