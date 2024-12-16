<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UrlController;

Route::get('/', function () {    
    return view('home');
});

Route::get('/{code}', [UrlController::class, 'redirect']); // Public route for redirection