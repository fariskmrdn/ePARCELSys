<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function index() {
        return view('students.index');
    }

    public function login(Request $request) {
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

    public function logout() {
        Auth::logout();
        return to_route('parcel.index');
    }

    public function create() {
        return view('students.create');
    }

    // get inventory for unclaimed item
    public function getInventory() {
        return view('students.inventory');
    }

    // get record for registered item

    public function getRecords() {
        return view('students.records');
    }
}
