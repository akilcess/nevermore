<?php

namespace App\Http\Controllers;

use App\Models\MasterPegawai;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Routing\Controller;

class MasterPegawaiController extends Controller
{
    // Display list of pegawai
    public function index()
    {
        $pegawai = MasterPegawai::with('user')->get();
        return view('pageadmin.master_pegawai.index', compact('pegawai'));
    }

    // Show form for creating new pegawai
    public function create()
    {
        return view('pageadmin.master_pegawai.create');
    }

    // Store newly created pegawai
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'telepon' => 'required|string|max:255',
            'profil' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validate image file
            'email' => 'required|email|unique:users,email',
            'username' => 'required|string|max:255',
            'password' => 'required|string|confirmed|min:6',
        ]);

        // Handle file upload for profil
        $profilPath = null;
        if ($request->hasFile('profil')) {
            $profil = $request->file('profil');
            $profilPath = time() . '_' . $profil->getClientOriginalName();
            $profil->move(public_path('uploads/profil'), $profilPath); // Save to public/uploads/profil directory
        }

        // Create user with role 'pegawai'
        $user = User::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'pegawai',
        ]);

        // Create pegawai
        MasterPegawai::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'telepon' => $request->telepon,
            'profil' => $profilPath, // Store the path of the uploaded profile
            'user_id' => $user->id,
        ]);

        Alert::success('Success', 'Pegawai successfully created!');
        return redirect()->route('pegawai.index');
    }

    // Show form for editing pegawai
    public function edit($id)
    {
        $pegawai = MasterPegawai::findOrFail($id);
        $user = User::findOrFail($pegawai->user_id);

        return view('pageadmin.master_pegawai.edit', compact('pegawai', 'user'));
    }

    // Update pegawai
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'telepon' => 'required|string|max:255',
            'profil' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validate image file
            'email' => 'nullable|email',
            'username' => 'nullable|string|max:255',
            'password' => 'nullable|string|confirmed|min:6',
        ]);

        // Find existing pegawai and user
        $pegawai = MasterPegawai::findOrFail($id);
        $user = User::findOrFail($pegawai->user_id);

        // Handle file upload for profil
        if ($request->hasFile('profil')) {
            // Delete the old profile image if it exists
            if ($pegawai->profil && file_exists(public_path('uploads/profil/' . $pegawai->profil))) {
                unlink(public_path('uploads/profil/' . $pegawai->profil));
            }

            // Upload new profile image
            $profil = $request->file('profil');
            $profilPath = time() . '_' . $profil->getClientOriginalName();
            $profil->move(public_path('uploads/profil'), $profilPath);
        } else {
            $profilPath = $pegawai->profil; // If no new file, keep the old one
        }

        // Update pegawai
        $pegawai->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'telepon' => $request->telepon,
            'profil' => $profilPath, // Update with new file path if uploaded
        ]);

        // Update User
        $user->update([
            'nama' => $request->nama, // Ensure 'nama' is updated in the User model too
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->filled('password') ? bcrypt($request->password) : $user->password,
        ]);

        Alert::success('Success', 'Pegawai and associated user successfully updated!');
        return redirect()->route('pegawai.index');
    }

    // Delete pegawai
    public function destroy($id)
    {
        $pegawai = MasterPegawai::findOrFail($id);
        $user = User::findOrFail($pegawai->user_id);

        // Delete profile image if it exists
        if ($pegawai->profil && file_exists(public_path('uploads/profil/' . $pegawai->profil))) {
            unlink(public_path('uploads/profil/' . $pegawai->profil));
        }

        $pegawai->delete();
        $user->delete();

        Alert::success('Deleted', 'Pegawai and associated user successfully deleted!');
        return redirect()->route('pegawai.index');
    }
}
