<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\RegisterUser;
use App\Models\Keranjang;
use App\Models\Checkout;
use Illuminate\Routing\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class ManageCustomerController extends Controller
{
    // List all users with their details
    public function index()
    {
        $users = RegisterUser::with('user')->get(); // Get RegisterUsers with User details
        return view('pageadmin.customer.index', compact('users')); // Return view with users
    }

    // Delete RegisterUser and related data
    public function delete($registerUserId)
    {
        $registerUser = RegisterUser::find($registerUserId);

        if ($registerUser) {
            $userId = $registerUser->user_id;

            // Delete related Keranjang and Checkout records
            Keranjang::where('user_id', $userId)->delete();
            Checkout::where('user_id', $userId)->delete();

            // Delete User associated with RegisterUser
            User::where('id', $userId)->delete();

            // Finally, delete RegisterUser
            $registerUser->delete();

            Alert::success('Deleted', 'RegisterUser and related data deleted successfully.');
            return redirect()->route('admin.users.index');
        }

        Alert::error('Error', 'RegisterUser not found.');
        return redirect()->route('admin.users.index');
    }
}
