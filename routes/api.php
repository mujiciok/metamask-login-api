<?php

use App\Http\Controllers\MetadataController;
use App\Http\Controllers\MetamaskLoginController;
use App\Http\Controllers\NftController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('metamask-auth', [MetamaskLoginController::class, 'login']);

// @TODO commented for browser testing on generate metadata endpoint
Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('users')->group(function () {
        Route::get('{user}', [UserController::class, 'show']);
    });
    Route::prefix('nfts')->group(function () {
        Route::get('', [NftController::class, 'index']);
        Route::get('{nft}', [NftController::class, 'show']);
        Route::put('{nft}/publish', [NftController::class, 'publish']);
        Route::post('', [NftController::class, 'store']);
    });
    Route::prefix('metadatas')->group(function () {
        Route::get('{nft}/generate', [MetadataController::class, 'generate']);
        Route::post('{nft}', [MetadataController::class, 'store']);
    });
});

