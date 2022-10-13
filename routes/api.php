<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KampusController;
use App\Http\Controllers\Api\Auth\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
	Route::resource('kampus', KampusController::class);
	Route::get('kampus/cari/{nama}', [KampusController::class, 'cari']);
	Route::put('kampus/mengikuti_kampus/{id_kampus}', [KampusController::class, 'mengikuti_kampus']);
	Route::post('kampus/daftar_ikut_kampus/', [KampusController::class, 'daftar_ikut_kampus']);
	Route::get('kampus/daftar_jurusan/{id_kampus}', [KampusController::class, 'daftar_jurusan']);
});

// Route::get('kampus/ikutkampus', [KampusController::class, 'ikutkampus']);
