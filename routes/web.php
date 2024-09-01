<?php


use App\Http\Controllers\RouteController;
use Illuminate\Support\Facades\Route;
use \Inertia\Inertia;


Route::get('/', [RouteController::class, 'index'])->name('route.index');
Route::get('/create', [RouteController::class, 'create'])->name('route.create');
Route::post('/store', [RouteController::class, 'store'])->name('route.store');
Route::get('/{id}', [RouteController::class, 'show'])->name('route.show');
Route::get('/{id}/edit', [RouteController::class, 'edit'])->name('route.edit');
Route::put('/{id}', [RouteController::class, 'update'])->name('route.update');
Route::delete('/{id}', [RouteController::class, 'destroy'])->name('route.destroy');













