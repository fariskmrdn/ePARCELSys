<?php

use App\Http\Controllers\ParcelController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;


Route::name('parcel.')->group(function() {
    Route::get('/', [ParcelController::class, 'index'])->name('index');
    Route::post('/find', [ParcelController::class, 'findByTrackingNo'])->name('findParcel');
    Route::get('/search', [ParcelController::class, 'item'])->name('search');
    Route::get('/login', [ParcelController::class, 'login'])->name('login');
});

Route::name('students.')->group(function() {
    Route::get('/students/index', [StudentController::class, 'index'])->name('index');
    Route::get('/students/create', [StudentController::class, 'create'])->name('create');
    Route::get('/students/inventory', [StudentController::class, 'inventory'])->name('inventory');
    Route::get('/students/records', [StudentController::class, 'records'])->name('records');
});
