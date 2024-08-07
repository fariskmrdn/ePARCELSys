<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\User;
use App\Models\Parcel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function index()
    {
        $item = $this->registeredItem();
        $unretrieved = $this->unretrievedItem();
        return view('students.index', compact('item', 'unretrieved'));
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        // check user exist or not?
        $user = User::where('email', $validated['email'])->first();
        if ($user) {
            if ($user['status'] == '0') {
                return back()->with([
                    'result' => 'error',
                    'title' => 'Log Masuk Gagal',
                    'message' => 'Akaun tidak aktif/telah dinyahaktif. Sila hubungi pihak HEP untuk makluman lanjut.'
                ]);
            }
            $validated['email'] = $user['email'];
            if (Auth::attempt($validated)) {
                $user->update([
                    'last_login_at' => now()
                ]);
                return to_route('students.index');
            }
            return back()->with([
                'result' => 'error',
                'title' => 'Log Masuk Gagal',
                'message' => 'Emel atau kata laluan tidak tepat!'
            ]);
        } else {
            return back()->with([
                'result' => 'error',
                'title' => 'Akaun tidak wujud!',
                'message' => 'Sila daftar akaun anda dan cuba sekali lagi.'
            ]);
        }
    }

    public function logout()
    {
        Auth::logout();
        return to_route('parcel.login');
    }

    public function create()
    {
        return view('students.create');
    }

    // get inventory for unclaimed item
    public function getInventory()
    {
        $item = $this->inventoryRecords();
        return view('students.inventory', compact('item'));
    }

    // get record for registered item

    public function getRecords()
    {
        $item = $this->retrieveRecords();

        return view('students.records', compact('item'));
    }

    public function registeredItem()
    {
        $userId = Auth::id();
        $count = Parcel::where('user_id', $userId)
            ->count();
        return $count;
    }

    public function unretrievedItem()
    {
        $email = Auth::user()->email;
        $count = DB::table('inventory')->where('email', $email)->where('status', '1')->count();
        return $count;
    }


    public function retrieveRecords()
    {
        $userId = Auth::id();
        $find = DB::table('pre_item')->where('user_id', $userId)->get();
        return $find;
    }

    public function inventoryRecords()
    {
        $email = Auth::user()->email;
        $get = Inventory::where('email', $email)->where('status', '1')->get();
        return $get;
    }
}
