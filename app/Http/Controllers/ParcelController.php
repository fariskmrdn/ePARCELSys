<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function login() {
        return view('login');
    }
}