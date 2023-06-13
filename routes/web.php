<?php

use App\Http\Controllers\APIController;
use App\Http\Controllers\DataController;
use App\Models\BarangModel;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $data = BarangModel::where('status','bisa dijual')->get();
    return view('form', compact('data'));
});

Route::match(['get', 'post'], '/get-data', [APIController::class, 'getdataapi'])->name('getdata');

Route::resource('dataCRUD', DataController::class);
