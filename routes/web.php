<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\Admin\RoomTypeController;
use App\Http\Controllers\Admin\FacilityController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Resepsionis\ReservationController as ResepsionisReservationController;
use App\Http\Controllers\Resepsionis\DashboardController as ResepsionisDashboardController;
use App\Http\Controllers\Resepsionis\RoomsController;
use App\Http\Controllers\Resepsionis\GuestController;

// Guest routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/room-types/{id}', [HomeController::class, 'roomTypeDetail'])->name('room-type.detail');
Route::get('/reserve/{room_type}', [ReservationController::class, 'create'])->name('reservation.create');
Route::post('/reserve', [ReservationController::class, 'store'])->name('reservation.store');
Route::get('/reservation/print/{code}', [ReservationController::class, 'print'])->name('reservation.print');

// Auth routes
Auth::routes(); // cukup sekali

// Admin routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('room-types', RoomTypeController::class);
    Route::resource('facilities', FacilityController::class);
    Route::resource('rooms', RoomController::class);
    Route::resource('users', UserController::class);
});

// Resepsionis routes
Route::middleware(['auth', 'role:resepsionis'])->prefix('resepsionis')->name('resepsionis.')->group(function () {
    Route::get('/', [ResepsionisDashboardController::class, 'index'])->name('dashboard');
    Route::get('/reservations', [ResepsionisReservationController::class, 'index'])->name('reservations.index');
    Route::get('/reservations/{id}', [ResepsionisReservationController::class, 'show'])->name('reservations.show');
    Route::resource('guests', GuestController::class);
    Route::resource('rooms', RoomsController::class)->only(['index', 'show']);
});

// Fallback
Route::fallback(fn() => response()->view('errors.404', [], 404));
