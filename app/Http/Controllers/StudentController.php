<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index() {
        return view('students.index');
    }

    public function create() {
        return view('students.create');
    }

    // get inventory for unclaimed item
    public function getInventory() {

    }

    // get record for registered item

    public function getRecords() {
        
    }
}
