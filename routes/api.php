<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/users', function (Request $request) {
    return User::all();
});

Route::prefix('v1')->group( base_path( 'routes/api_v1.php' ) );
Route::prefix('v2')->group( base_path( 'routes/api_v2.php' ) );