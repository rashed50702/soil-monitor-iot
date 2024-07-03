<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ThingSpeakController;

Route::get('/', [ThingSpeakController::class, 'showData']);
