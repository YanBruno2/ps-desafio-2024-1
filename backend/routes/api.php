<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

Route::apiResource('categoria', CategoryController::class);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/profile', function (Request $request) {
        return response()->json(Auth::user(), Response::HTTP_OK);
    });
});

Route::middleware(['auth:sanctum', 'can:admin'])->group(function () {
    Route::apiResource('/users', UserController::class);

    //rota de categoria que necessita de autenticação
    Route::apiResource('categoria', CategoryController::class)->except('index', 'show');
});

//definindo rota de index e show de categoria sem autenticação
Route::get('categoria', [CategoryController::class, 'index']);
Route::get('categoria/{id}', [CategoryController::class, 'show']);

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

require __DIR__.'/auth.php';
