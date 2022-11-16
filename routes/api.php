<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PersonController;
use App\Http\Controllers\API\EnderecoController;
use App\Http\Controllers\API\UsuarioController;
use App\Http\Controllers\API\LivroController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('livro')->group(function () {
    Route::get('/',[LivroController::class, 'getAll']);
    Route::post('/',[LivroController::class, 'create']);
    Route::delete('/{id}',[LivroController::class, 'delete']);
    Route::get('/{id}',[LivroController::class, 'get']);
    Route::put('/{id}',[LivroController::class, 'update']);
});

Route::prefix('user')->group(function () {
    Route::get('/',[ UsuarioController::class, 'getAll']);
    Route::post('/',[ UsuarioController::class, 'create']);
    Route::delete('/{id}',[ UsuarioController::class, 'delete']);
    Route::get('/{id}',[ UsuarioController::class, 'get']);
    Route::put('/{id}',[ UsuarioController::class, 'update']);
});

Route::prefix('person')->group(function () {
    Route::get('/',[ PersonController::class, 'getAll']);
    Route::post('/',[ PersonController::class, 'create']);
    Route::delete('/{id}',[ PersonController::class, 'delete']);
    Route::get('/{id}',[ PersonController::class, 'get']);
    Route::put('/{id}',[ PersonController::class, 'update']);
});


Route::prefix('endereco')->group(function () {
    Route::get('/',[ EnderecoController::class, 'getAll']);
    Route::post('/',[ EnderecoController::class, 'create']);
    Route::delete('/{id}',[ EnderecoController::class, 'delete']);
    Route::get('/{id}',[ EnderecoController::class, 'get']);
    Route::put('/{id}',[ EnderecoController::class, 'update']);
});

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
