<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('events', [\App\Http\Controllers\Api\V1\EventController::class, 'index']);