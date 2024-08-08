<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use App\Models\Inventory;
use App\Mail\ItemRegistered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function admin_index()
    {
        return view('admins.login');
    }

    public function login(Request $request)
    {
        try {
            $validated = $request->validate([
                'username' => 'required|string',
                'password' => 'required|string'
            ]);

        } catch (\Exception $e) {
            \Log::error('Validation error: ' . $e->gettext());

            return back()->with([
                'icon' => 'error',
                'title' => 'Log Masuk Gagal',
                'text' => 'Sila pastikan maklumat yang dimasukkan adalah tepat'
            ]);
        }

        try {
            // check user exist or not?
            $user = Admin::where('username', $validated['username'])->first();
            if ($user) {
                if ($user['status'] == '2') {
                    return back()->with([
                        'icon' => 'error',
                        'title' => 'Log Masuk Gagal',
                        'text' => 'Akaun tidak aktif/telah dinyahaktif'
                    ]);
                }
                $validated['username'] = $user['username'];
                if (Auth::guard('admin')->attempt($validated)) {
                    $user->update([
                        'last_login' => now()
                    ]);
                    \Log::info($user);
                    return to_route('admins.admin.dashboard');
                }
                return back()->with([
                    'icon' => 'error',
                    'title' => 'Log Masuk Gagal',
                    'text' => 'Nama pengguna atau kata laluan tidak tepat!'
                ])->withInput($request->all());

            } else {
                return back()->with([
                    'icon' => 'error',
                    'title' => 'Akaun tidak wujud!',
                    'text' => 'Sila daftar akaun anda dan cuba sekali lagi.'
                ])->withInput($request->all());
            }
        } catch (\Exception $e) {
            \Log::error('Login error: ' . $e->gettext());

            return back()->with([
                'icon' => 'error',
                'title' => 'Log Masuk Gagal',
                'text' => 'Nama pengguna atau kata laluan tidak tepat!'
            ])->withInput($request->all());
        }

    }
    public function logout()
    {
        Auth::logout();
        return to_route('admin.index');
    }

    public function dashboard()
    {
        $showFiveInventory = $this->showFiveInventory();
        $showFiveClaimedItem = $this->showFiveClaimedItem();
        $countItem = $this->countItem();
        $countAccounts = $this->countAccounts();

        return view('admins.dashboard', compact('showFiveInventory', 'showFiveClaimedItem', 'countItem', 'countAccounts'));
    }

    public function addPage()
    {
        return view('admins.add');
    }

    public function recordPage()
    {
        $record = $this->allRecords();
        return view('admins.records', compact('record'));
    }

    public function showFiveInventory()
    {
        $show = DB::table('pre_item')->orderBy('created_at', 'desc')->limit(5)->get();
        return $show;
    }

    public function showFiveClaimedItem()
    {
        $show = DB::table('inventory')->orderBy('updated_at', 'desc')->where('status', '2')->limit(5)->get();
        return $show;
    }

    public function countItem()
    {
        $show = DB::table('inventory')->where('status', '1')->count();
        return $show;
    }

    public function countAccounts()
    {
        $show = DB::table('users')->count();
        return $show;
    }
    public function allRecords()
    {
        $show = DB::table('inventory')
            ->leftJoin('admin', 'inventory.admin_id', '=', 'admin.id')
            ->select('inventory.*', 'admin.admin_name as admin_name')
            ->orderBy('inventory.created_at', 'desc')
            ->get();
        return $show;
    }

    public function registerParcel(Request $request)
    {

        // VALIDATE THE TRACKING NUMBER INPUTTED FIRST
        try {
            $validated = $request->validate([
                'tracking_no' => 'required|string|max:255'
            ]);
        } catch (\Exception $e) {
            return back()->with([
                'icon' => 'error',
                'title' => 'Daftar Masuk Gagal!',
                'text' => 'Sila semak semula no tracking yang di isi dan cuba semula'
            ]);
        }

        // QUERY BUILDER TO FIND THE PRE-REGISTERED PARCEL
        $find_pre_item = DB::table('pre_item')
            ->join('users', 'pre_item.user_id', 'users.id')
            ->where('tracking_no', $validated['tracking_no'])
            ->select('pre_item.*', 'users.email', 'users.name')
            ->first();

        $admin_id = Auth::guard('admin')->user()->id;

        // SEE WHETHER PARCEL IS FOUNDED
        if ($find_pre_item) {
            // IF THE PARCEL IS ALREADY CHECKED IN
            if ($find_pre_item->status == '1') {
                return back()->with([
                    'icon' => 'error',
                    'title' => 'Daftar Masuk Gagal!',
                    'text' => 'Barang ini telah didaftarkan! Sila semak rekod inventori.'
                ]);
            }

            // IF PARCEL CONDITION IS VALID, BEGIN WITH UPDATE AND INSERT
            try {
                DB::beginTransaction();
                DB::table('pre_item')->where('tracking_no', $validated['tracking_no'])->update([
                    'status' => '1',
                    'updated_at' => now()
                ]);
                $serial_no = 'KVKS-HEP-' . rand(1, 999);
                DB::table('inventory')->insert([
                    'tracking' => $validated['tracking_no'],
                    'status' => '1', // Set the initial status here
                    'receiver' => $find_pre_item->name,
                    'email' => $find_pre_item->email,
                    'admin_id' => $admin_id,
                    'serial_no' => $serial_no,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
                DB::commit();
                Mail::to($find_pre_item->email)->send(new ItemRegistered(['name' => $find_pre_item->name, 'tracking' => $validated['tracking_no'], 'no' => $serial_no]));

                return back()->with([
                    'icon' => 'success',
                    'title' => 'Daftar Masuk Berjaya!',
                    'text' => 'Daftar masuk barangan berjaya didaftarkan (Kod Item: ' . $serial_no . ' )'
                ]);
            } catch (\Exception $e) {
                return back()->with([
                    'icon' => 'error',
                    'title' => 'Daftar Masuk Gagal!',
                    'text' => 'Ralat! Sila cuba sebentar lagi.'
                ]);
            }

        } else {
            // Redirect to registration form
            return redirect()->route('admins.admin.register_form', ['tracking_no' => $validated['tracking_no']]);
        }

    }

    public function registerNewItem(Request $request)
    {
        try {
            $validated = $request->validate([
                'tracking_no' => 'required|string|max:225',
                'courier_name' => 'required|string|max:100',
                'receiver' => 'required|string|max:255',
            ]);

        } catch (\Exception $e) {
            return back()->with([
                'icon' => 'error',
                'title' => 'Daftar Masuk Gagal!',
                'text' => 'Sila semak semula no tracking yang di isi dan cuba semula'
            ]);
        }

        if ($validated['courier_name'] == '0') {
            $validated['courier_name'] == NULL;
        }

        $serial_no = 'KVKS-HEP-' . rand(1, 999);

        try {
            DB::beginTransaction();

            $insert = Inventory::insert([
                'receiver' => $validated['receiver'],
                'tracking' => $validated['tracking_no'],
                'courier' => $validated['courier_name'],
                'admin_id' => Auth::guard('admin')->user()->id,
                'serial_no' => $serial_no,
            ]);
            DB::commit();
            return back()->with([
                'icon' => 'success',
                'title' => 'Daftar Masuk Berjaya!',
                'text' => 'Daftar masuk barangan berjaya didaftarkan (Kod Item: ' . $serial_no . ' )'
            ]);
        } catch (\Exception $e) {
            // dd($e);
            DB::rollBack();
            return back()->with([
                'icon' => 'error',
                'title' => 'Daftar Masuk Gagal!',
                'text' => 'Ralat! Sila cuba sebentar lagi.'
            ]);
        }
    }

    public function showParcelRegisterForm(Request $request)
    {
        $trackingNo = $request->query('tracking_no');
        return view('admins.registration', compact('trackingNo'));
    }

    public function deleteItem($id)
    {
        try {
            DB::beginTransaction();
            DB::table('inventory')->where('id', $id)->delete();
            DB::commit();
            return back()->with([
                'icon' => 'success',
                'title' => 'Berjaya!',
                'text' => 'Rekod berjaya dihapuskan.'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with([
                'icon' => 'error',
                'title' => 'Ralat!',
                'text' => 'Terdapat ralat semasa menghapuskan rekod. Sila cuba lagi.'
            ]);
        }
    }

    public function changeToClaim($tracking)
    {
        try {
            DB::beginTransaction();
            DB::table('inventory')->where('tracking', $tracking)->update([
                'status' => '2',
                'updated_at' => now(),
            ]);

            $find_pre_item = DB::table('pre_item')->where('tracking_no', $tracking)->first();

            if ($find_pre_item) {
                DB::table('pre_item')->where('tracking_no', $tracking)->update([
                    'status' => '2',
                    'updated_at' => now(),
                ]);
            }
            DB::commit();
            return back()->with([
                'icon' => 'success',
                'title' => 'Berjaya!',
                'text' => 'Item berjaya dituntut.'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return to_route('admins.admin.records')->with([
                'icon' => 'error',
                'title' => 'Ralat!',
                'text' => 'Terdapat ralat semasa mengemaskini rekod. Sila cuba lagi.'
            ]);
        }
    }

    public function documentation()
    {
        return view('admins.documentation');
    }

    public function userLists()
    {
        $users = User::all();
        return view('admins.users', compact('users'));
    }

    public function setPswdPage()
    {
        return view('admins.set_password');
    }

    public function setNewPassword(Request $request)
    {
        // Check the current password
        try {
            DB::beginTransaction();
            $request->merge([
                'new_password' => trim($request->input('new_password')),
                'password_confirmation' => trim($request->input('password_confirmation')),
            ]);

            // Validate the request
            $validated = $request->validate([
                'current_password' => 'required|string',
                'new_password' => 'required|string|min:8',
                'password_confirmation' => 'required|string|min:8',
            ]);

            if ($validated['new_password'] !== $validated['password_confirmation']) {
                \Log::error('Password confirmation does not match.');
                return back()->with([
                    'icon' => 'error',
                    'title' => 'Gagal!',
                    'text' => 'Kata laluan baru dan pengesahan kata laluan tidak sepadan.'
                ]);
            }

            $auth = Auth::guard('admin')->user();

            if (Hash::check($validated['current_password'], $auth->password)) {
                // Update the password
                $auth->password = Hash::make($validated['new_password']);
                $auth->save();

                DB::commit();
                return back()->with([
                    'icon' => 'success',
                    'title' => 'Berjaya!',
                    'text' => 'Kata Laluan berjaya di set semula'
                ]);
            } else {
                return back()->with([
                    'icon' => 'error',
                    'title' => 'Gagal!',
                    'text' => 'Kata laluan semasa tidak betul.'
                ]);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with([
                'icon' => 'error',
                'title' => 'Gagal!',
                'text' => 'Kata laluan gagal di set semula. Sila pastikan kata laluan terdahulu adalah tepat sebelum meneruskan proses set semula kata laluan.'
            ]);
        }
    }

    public function showUser($id)
    {
        try {
            // find user
            $id = decrypt_string($id);
            $user = User::find($id);
            $email = $user->email;
            if (!$user) {
                return back()->with([
                    'icon' => 'error',
                    'title' => 'Maklumat tidak dijumpai!',
                    'text' => 'Maklumat dan profil tidak wujud atau tidak dijumpai.'
                ]);
            } else {
                $findItem = DB::table('inventory')
                    ->join('users', 'inventory.email', '=', 'users.email')
                    ->where('inventory.email', $email)
                    ->select('inventory.*', 'users.name as user_name', 'users.email as user_email')
                    ->get();
            }
            return view('admins.user', compact('user', 'findItem'));

        } catch (\Exception $e) {
            return back()->with([
                'icon' => 'error',
                'title' => 'Forbidden Access',
                'text' => 'Error : ' . $e->getMessage() . '',
            ]);
        }
    }

    public function changeStudentStatus($id)
    {
        try {

            // Decrypt the ID
            $id = decrypt_string($id);

            // Find the user
            $user = User::find($id);

            // If user not found, return error response
            if (!$user) {
                return back()->with([
                    'icon' => 'error',
                    'title' => 'Maklumat tidak dijumpai!',
                    'text' => 'Maklumat dan profil tidak wujud atau tidak dijumpai.'
                ]);
            }

            // Update user status
            $user->status = ($user->status == '1') ? '0' : '1';
            $user->save();
         

            // Return success response
            return back()->with([
                'icon' => 'success',
                'title' => 'Berjaya!',
                'text' => 'Status akaun berjaya dikemaskini'
            ]);
        } catch (\Exception $e) {
            \Log::error('Error changing user status: ' . $e->getMessage());

            // Return error response
            return back()->with([
                'icon' => 'error',
                'title' => 'Forbidden Access',
                'text' => 'Error : ' . $e->getMessage()
            ]);
        }
    }



}
