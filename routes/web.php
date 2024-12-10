<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('redirectIfAuthenticated')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
});
Route::get('/dashboard', function () {
    if (Auth::user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/admin-dashboard', function () {
    if (Auth::check() && Auth::user()->role === 'admin') {
        $users = User::all(); // Obține toți utilizatorii
        return view('admin.dashboard', compact('users'));
    }

    abort(403, 'Unauthorized action.');
})->middleware('auth')->name('admin.dashboard');

Route::get('/user-dashboard/{id}', function ($id) {
    $user = \App\Models\User::findOrFail($id);

    // Permite administratorului să vadă panourile tuturor utilizatorilor
    if (Auth::user()->role === 'admin' || Auth::id() === $user->id) {
        return view('user.dashboard', compact('user'));
    }

    abort(403, 'Unauthorized action.');
})->middleware('auth')->name('user.dashboard');

require __DIR__ . '/auth.php';
