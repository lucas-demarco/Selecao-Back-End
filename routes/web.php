<?php

use App\Http\Controllers\UsersController;
use App\Http\Controllers\ProdutosController;
use App\Http\Controllers\ComentariosController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProdutosController::class, 'index'])->name('produtos');
Route::get('/produto/{id}', [ProdutosController::class, 'visualizar'])->name('produtos.visualizar');
Route::get('/historico_comentario/{id}', [ComentariosController::class, 'historico'])->where('id', '[0-9]+')->name('comentarios.historico');

Route::prefix('comentario')->group(function() {
    Route::post('/{id}', [ComentariosController::class, 'adicionar'])->where('id', '[0-9]+')->name('comentarios.adicionar');
    Route::get('/{id}', [ComentariosController::class, 'listar'])->where('id', '[0-9]+')->name('comentarios.listar');
    Route::put('/', [ComentariosController::class, 'update'])->name('comentarios.update');
    Route::delete('/', [ComentariosController::class, 'destroy'])->name('comentarios.delete');
});

Route::prefix('users')->group(function() {
    Route::get('/', [UsersController::class, 'index'])->name('users.index');
    Route::get('/edit/{id}', [UsersController::class, 'edit'])->where('id', '[0-9]+')->name('users.edit');
    Route::put('/{id}', [UsersController::class, 'update'])->where('id', '[0-9]+')->name('users.update');
    Route::get('/{id}', [UsersController::class, 'ativar_inativar'])->where('id', '[0-9]+')->name('users.ativar_inativar');
    Route::delete('/{id}', [UsersController::class, 'destroy'])->where('id', '[0-9]+')->name('users.destroy');
});

require __DIR__.'/auth.php';
