<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function admin_index()
    {
        return view('admins.login');
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
        $show = DB::table('inventory')->orderBy('created_at', 'desc')->get();
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
                    'admin_id' => '1',
                    'serial_no' => $serial_no,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
                DB::commit();
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

    public function documentation() {
        return view('admins.documentation');
    }
}
