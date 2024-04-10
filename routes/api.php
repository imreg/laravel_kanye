<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuoteController;

Route::get('/quotes', [QuoteController::class, 'index'])
    ->middleware(\App\Http\Middleware\AuthenticateApiToken::class);
Route::get('/quotes/refresh', [QuoteController::class, 'refresh'])
    ->middleware(\App\Http\Middleware\AuthenticateApiToken::class);
