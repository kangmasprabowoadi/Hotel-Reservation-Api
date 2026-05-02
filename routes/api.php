<?php

use App\Http\Controllers\Api\HotelController;
use Illuminate\Support\Facades\Route;

// Endpoint: http://127.0.0.1:8000/api/rooms
Route::get('/rooms', [HotelController::class, 'getRooms']);

// Endpoint: http://127.0.0.1:8000/api/reserve
Route::post('/reserve', [HotelController::class, 'storeReservation']);