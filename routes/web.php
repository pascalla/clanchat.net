<?php

use App\Http\Controllers\ClanController;
use App\Http\Controllers\ClanGuestController;
use App\Http\Controllers\ClanSecretController;
use App\Http\Controllers\ClanSettingController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
});

// Page Routes
Route::resource('clan', ClanController::class)->only('show');

// Resource Routes
Route::prefix('api')->group(function () {
    Route::resource('clan', ClanController::class)->except('show');
    Route::resource('clan-secret', ClanSecretController::class)->except(['show', 'index', 'edit', 'update', 'create', 'destroy']);
    Route::get('clan-secret/{clan}', [ClanSecretController::class, 'show']);
    Route::delete('clan-secret/{clan_secret_id}', [ClanSecretController::class, 'destroy']);
    Route::resource('clan-settings', ClanSettingController::class);
    Route::get('clan-guest/{clan}', [ClanGuestController::class, 'show']);
    Route::post('clan-guest', [ClanGuestController::class, 'store']);
    Route::delete('clan-guest/{clan_guest_id}', [ClanGuestController::class, 'destroy']);

    // Custom routes for adding and removing a user to/from a clan
    Route::post('clan/{clan}/add-user', [ClanController::class, 'addUserToClan'])->name('clan.addUser');
    Route::delete('clan/{clan}/remove-user/{user}', [ClanController::class, 'removeUserFromClan'])->name('clan.removeUser');
    Route::get('clan/{clan}', [ClanController::class, 'show']);
});

Route::prefix('webhook')->group(function () {
    Route::post('{clan_secret}', [MessageController::class, 'store']);
});
