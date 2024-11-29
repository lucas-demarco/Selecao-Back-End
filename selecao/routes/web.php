<?php

use App\Http\Controllers\UsersController;
use App\Http\Controllers\ProdutosController;
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

Route::get('/', [ProdutosController::class, 'index'])->name('produtos');

Route::prefix('users')->group(function(){
    Route::get('/', [UsersController::class, 'index'])->name('users.index');
    Route::get('/edit/{id}', [UsersController::class, 'edit'])->where('id', '[0-9]+')->name('users.edit');
    Route::put('/{id}', [UsersController::class, 'update'])->where('id', '[0-9]+')->name('users.update');
    Route::get('/{id}', [UsersController::class, 'ativar_inativar'])->where('id', '[0-9]+')->name('users.ativar_inativar');
    Route::delete('/{id}', [UsersController::class, 'destroy'])->where('id', '[0-9]+')->name('users.destroy');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
