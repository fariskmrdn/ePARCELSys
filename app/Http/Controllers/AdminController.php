<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function admin_index() {
        return view('admins.login');
    }

    public function dashboard() {
        $showFiveInventory = $this->showFiveInventory();
        $showFiveClaimedItem = $this->showFiveClaimedItem();
        $countItem = $this->countItem();
        $countAccounts = $this->countAccounts();

        return view('admins.dashboard', compact('showFiveInventory','showFiveClaimedItem','countItem','countAccounts'));
    }

    public function addPage() {
        return view('admins.add');
    }

    public function recordPage() {
        $record = $this->allRecords();
        return view('admins.records', compact('record'));
    }

    public function showFiveInventory() {
        $show = DB::table('pre_item')->orderBy('created_at', 'desc')->limit(5)->get();
        return $show;
    }

    public function showFiveClaimedItem() {
        $show = DB::table('inventory')->orderBy('updated_at', 'desc')->where('status','2')->limit(5)->get();
        return $show;
    }

    public function countItem() {
        $show = DB::table('inventory')->where('status','1')->count();
        return $show;
    }

    public function countAccounts() {
        $show = DB::table('users')->count();
        return $show;
    }

    public function allRecords() {
        $show = DB::table('inventory')->orderBy('created_at','desc')->get();
        return $show;
    }
}
