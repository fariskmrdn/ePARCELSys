<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ParcelController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ParcelController::class, 'index'])->name('index');
Route::get('/admin', [AdminController::class, 'admin_index'])->name('admin.index');
Route::post('/admin/login', [AdminController::class,'login'])->name('admin.login');

Route::middleware(['auth:admin'])->group(function () {
    Route::name('admins.')->group(function () {

        // GET METHOD
        Route::get('/admin/register_form', [AdminController::class, 'showParcelRegisterForm'])->name('admin.register_form');
        Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/admin/register_item', [AdminController::class, 'addPage'])->name('admin.addPage');
        Route::get('/admin/records', [AdminController::class, 'recordPage'])->name('admin.records');
        Route::get('/admin/users', [AdminController::class, 'userLists'])->name('admin.users');
        Route::get('/admin/set_password', [AdminController::class, 'setPswdPage'])->name('admin.set');
        Route::get('/admin/documentation', [AdminController::class, 'documentation'])->name('admin.documentation');
        Route::get('/admin/documentation', [AdminController::class, 'documentation'])->name('admin.documentation');
        Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
        Route::get('admin/users/{id}', [AdminController::class, 'showUser'])->name('admin.show_user');

        // POST METHOD
        Route::post('/admin/registering', [AdminController::class, 'registerParcel'])->name('admin.register');
        Route::post('/admin/register', [AdminController::class, 'registerNewItem'])->name('admin.add');

        // DELETE METHOD
        Route::delete('/admin/delete_item/{id}', [AdminController::class, 'deleteItem'])->name('admin.delete_item');

        // PATCH METHOD
        Route::patch('/admin/claim/{id}', [AdminController::class, 'changeToClaim'])->name('admin.claimed');
        Route::patch('/admin/reset', [AdminController::class, 'setNewPassword'])->name('admin.set_new_password');
        Route::patch('/admin/user_status/{id}', [AdminController::class, 'changeStudentStatus'])->name('admin.change_status');
    });
});


Route::post('/findParcel', [ParcelController::class, 'findByTrackingNo'])->name('findParcel');
Route::get('/search', [ParcelController::class, 'item'])->name('search');
Route::middleware('guest')->group(function () {
    Route::name('parcel.')->group(function () {

        // GET METHOD
        Route::get('/login', [ParcelController::class, 'login'])->name('login');
        Route::get('/register', [ParcelController::class, 'register'])->name('register');

        // POST METHOD
        Route::post('/registerAccount', [ParcelController::class, 'registerAccount'])->name('registerAccount');
        Route::post('/loginStudents', [StudentController::class, 'login'])->name('loginStudents');
    });
});

Route::middleware('auth')->group(function () {
    Route::name('students.')->group(function () {

        // GET METHOD
        Route::get('/students/index', [StudentController::class, 'index'])->name('index');
        Route::get('/students/create', [StudentController::class, 'create'])->name('create');
        Route::get('/students/inventory', [StudentController::class, 'getInventory'])->name('inventory');
        Route::get('/students/records', [StudentController::class, 'getRecords'])->name('records');
        Route::get('/logout', [StudentController::class, 'logout'])->name('logout');

        // POST METHOD
        Route::post('/students/add', [ParcelController::class, 'addParcel'])->name('addParcel');

    });
});



