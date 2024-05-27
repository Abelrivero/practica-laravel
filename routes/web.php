<?php

use App\Http\Controllers\ActorController;
use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;

Route::prefix('/configuracion')->group(function(){
    Route::prefix('/actores')->group(function(){
        Route::controller(ActorController::class)->group(function(){
            Route::get('/listar', 'index')->name('actorIndex');

            Route::get('/alta', 'create')->name('actorCreate');
            Route::post('/create', 'store')->name('actorStore');

            Route::get('/modificar/{actorId}', 'edit')->name('actorEdit');
            Route::put('/modificar/{actorId}', 'update')->name('actorUpdate');

            Route::delete('/baja/{actorId}', 'destroy')->name('actorDestroy');
        });
    });

    Route::prefix('/movies')->group(function(){
        Route::controller(MovieController::class)->group(function(){
            Route::get('/listar', 'index')->name('movieIndex');

            Route::get('/alta', 'create')->name('movieCreate');
            Route::post('/create', 'store')->name('movieStore');

            Route::get('/modificar/{movieId}', 'edit')->name('movieEdit');
            Route::put('/modificar/{movieId}', 'update')->name('movieUpdate');

            Route::delete('/baja/{movieId}', 'destroy')->name('movieDestroy');
        });
    });
});