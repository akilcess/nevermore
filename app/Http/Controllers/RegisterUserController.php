<?php

namespace App\Http\Controllers;

use App\Models\RegisterUser;
use App\Models\Provinsi;
use App\Models\Kabupaten;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class RegisterUserController extends Controller
{
    // Display list of pegawai
    public function index()
    {
        $provinces = Provinsi::all();  // Get all provinces
        $cities = Kabupaten::all();    // Get all cities (Kabupaten)

        return view('auth.registeruser', compact('provinces', 'cities'));
    }

    public function getKabupaten($province_id)
    {
        // Ambil semua kabupaten berdasarkan province_id
        $kabupaten = Kabupaten::where('province_id', $province_id)->get();

        // Return response dalam format JSON
        return response()->json($kabupaten);
    }


    // Store newly created user
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'province_id' => 'required',
            'city_id' => 'required',
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

        // Create user with role 'user'
        $user = User::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'user',
        ]);

        // Create user
        RegisterUser::create([
            'nama' => $request->nama,
            'province_id' => $request->province_id,
            'city_id' => $request->city_id,
            'alamat' => $request->alamat,
            'telepon' => $request->telepon,
            'profil' => $profilPath, // Store the path of the uploaded profile
            'status' => $request->status,
            'user_id' => $user->id,
        ]);

        Alert::success('Success', 'Register successfully created!');
        return redirect()->route('login');
    }

    // Show form for editing pegawai
    public function editprofile()
    {
        $auth = Auth::user();
        $profileuser = RegisterUser::where('user_id', $auth->id)->firstOrFail();

        // Ambil semua data provinsi dan kota
        $provinces = Provinsi::all();
        $cities = Kabupaten::all(); // Kota berdasarkan provinsi

        // Ambil provinsi dan kota yang sesuai dengan id
        $province = Provinsi::where('province_id', $profileuser->province_id)->first();
        $city = Kabupaten::where('city_id', $profileuser->city_id)->first();

        return view('pageweb.profil', compact('profileuser', 'auth', 'province', 'city', 'provinces', 'cities'));
    }

    






    // Update 
    public function updateprofile(Request $request, $user_id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'province_id' => 'required',
            'city_id' => 'required',
            'alamat' => 'required|string',
            'telepon' => 'required|string|max:255',
            'profil' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validate image file
            'email' => 'nullable|email',
            'username' => 'nullable|string|max:255',
            'password' => 'nullable|string|confirmed|min:6',
        ]);

        // Find existing 
        $profileuser = RegisterUser::findOrFail($user_id);
        $user = User::findOrFail($profileuser->user_id);

        // Handle file upload for profile image
        if ($request->hasFile('profil')) {
            // Delete the old profile image if it exists
            if ($profileuser->profil && file_exists(public_path('uploads/profil/' . $profileuser->profil))) {
                unlink(public_path('uploads/profil/' . $profileuser->profil));
            }

            // Upload new profile image
            $profil = $request->file('profil');
            $profilPath = time() . '_' . $profil->getClientOriginalName();
            $profil->move(public_path('uploads/profil'), $profilPath);
        } else {
            $profilPath = $profileuser->profil; // Keep the old file if no new file uploaded
        }

        // Update RegisterUser model
        $profileuser->update([
            'nama' => $request->nama,
            'province_id' => $request->province_id,
            'city_id' => $request->city_id,
            'alamat' => $request->alamat,
            'telepon' => $request->telepon,
            'profil' => $profilPath,
        ]);

        // Update User model
        $user->update([
            'nama' => $request->nama,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->filled('password') ? bcrypt($request->password) : $user->password,
        ]);

        Alert::success('Success', 'Profile user successfully updated!');
        return redirect()->route('profile.edit');
    }
}
