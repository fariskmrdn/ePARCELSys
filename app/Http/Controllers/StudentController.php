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
            $validated['email'] = $user['email'];
            if (Auth::attempt($validated)) {
                $user->update([
                    'last_login_at' => now()
                ]);
                return to_route('students.index');
            }
            return back()->with([
                'result' => 'error',
                'title' => 'Emel atau kata laluan tidak tepat!',
                'message' => 'Sila cuba semula.'
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
        return view('students.inventory');
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

    public function unretrievedItem() {
        $email = Auth::user()->email;
        $count = Inventory::where('email', $email)->count();
        return $count;
    }

    
    public function retrieveRecords() {
        $userId = Auth::id();
        $find = DB::table('pre_item')->where('user_id', $userId)->get();
        return $find;
    }
}
