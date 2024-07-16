<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ParcelController extends Controller
{
    public function findByTrackingNo(Request $request)
    {
        $validate = $request->validate(['track' => 'required|string|max:255']);

        try {
            $find = DB::table('inventory')
                ->where('tracking', $validate['track'])
                ->orWhere('receiver', $validate['track'])
                ->where('status', '1')
                ->get();

            if ($find->isEmpty()) {
                return response()->json(['error' => 'No parcel found with the given tracking number or receiver name.'], 404);
            }

            return redirect()->route('parcel.search')->with(['parcels' => $find, 'search' => $validate['track']]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while searching for the parcel.'], 500);
        }
    }

    public function item(Request $request)
    {
        $parcels = session('parcels', []);
        $search = session('search', '');
        return view('search', compact('parcels', 'search'));
    }

    public function index()
    {
        return view('index');
    }

    public function login()
    {
        return view('login');
    }

    public function register()
    {
        return view('register');
    }

    public function registerAccount(Request $request)
    {

        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users',
                'password' => 'required|confirmed|min:8'
            ]);

        } catch (\Exception $e) {
            return back()->with([
                'result' => 'error',
                'title' => 'Pendaftaran Gagal!',
                'message' => 'Sila pastikan anda mengisi dengan tepat borang pendaftaran ini.'
            ]);
        }


        try {
            DB::beginTransaction();

            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password'])
            ]);
            DB::commit();

            return to_route('parcel.login')->with([
                'result' => 'success',
                'title' => 'Pendaftaran Berjaya!',
                'message' => 'Akaun anda berjaya di daftarkan. Sila log masuk untuk teruskan.'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return to_route('parcel.login')->with([
                'result' => 'error',
                'title' => 'Pendaftaran Akaun Tidak Berjaya!',
                'message' => 'Sila cuba semula.'
            ]);
        }

    }
}