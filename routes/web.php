<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgtController;

Route::get('/',[AgtController::class,"index"])->name('homepage');

Route::post('/store',[AgtController::class,"store"])->name('store');
Route::put('/update/{id}',[AgtController::class,"edit"])->name('edit');

Route::delete('/drop/{id}',[AgtController::class,"drop"])->name('drop');


// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');
