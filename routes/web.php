<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductsController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/api/create-product', [ProductsController::class, 'create']);
    Route::get('/api/products', [ProductsController::class, 'index']);
    Route::post('api/edit-product/{id}', [ProductsController::class, 'update']);
    Route::delete('api/delete-product/{id}', [ProductsController::class, 'destroy']);

});

Route::get('user-role', function (Request $request) {
    return response()->json([
        'user' => $request->user(),
        'roles' => $request->user()->getRoleNames()->first(),
    ]);
})->middleware('auth');

require __DIR__.'/auth.php';
