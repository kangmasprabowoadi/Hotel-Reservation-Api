<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// ==========================================
// API SYSTEM HOTEL AMANJIWO - KELOMPOK 2
// ==========================================

// ------------------------------------------
// 1. ENDPOINT AUTENTIKASI & USER
// ------------------------------------------

// POST /api/signup - Registrasi user baru
Route::post('/signup', function (Request $request) {
    return response()->json([
        "status" => true,
        "message" => "Registrasi berhasil",
        "data" => [
            "id" => 1,
            "name" => $request->name ?? "Azzam",
            "email" => $request->email ?? "azzam@gmail.com"
        ]
    ], 201); // 201 = Status Created (Data berhasil dibuat)
});

// POST /api/auth/login - Login user
Route::post('/auth/login', function (Request $request) {
    return response()->json([
        "status" => true,
        "message" => "Login berhasil",
        "token" => "abc123token"
    ], 200);
});

// DELETE /api/users/{user_id} - Hapus data user
Route::delete('/users/{user_id}', function ($user_id) {
    return response()->json([
        "status" => true,
        "message" => "Data user dengan ID $user_id berhasil dihapus"
    ], 200);
});


// ------------------------------------------
// 2. ENDPOINT KAMAR (ROOMS)
// ------------------------------------------

// GET /api/type-room - Mengambil semua tipe kamar
Route::get('/type-room', function () {
    return response()->json([
        "status" => true,
        "message" => "List tipe kamar",
        "data" => [
            ["id" => 1, "name" => "Single Room", "price" => 300000],
            ["id" => 2, "name" => "Double Room", "price" => 500000],
            ["id" => 3, "name" => "Deluxe Room", "price" => 750000],
            ["id" => 4, "name" => "Suite Room", "price" => 1200000]
        ]
    ], 200);
});

// GET /api/rooms/availability - Cek ketersediaan kamar
Route::get('/rooms/availability', function () {
    return response()->json([
        "status" => true,
        "message" => "Kamar tersedia",
        "data" => [
            ["room_id" => 101, "type" => "Single Room", "status" => "available"],
            ["room_id" => 205, "type" => "Deluxe Room", "status" => "available"]
        ]
    ], 200);
});


// ------------------------------------------
// 3. ENDPOINT RESERVASI (BOOKING)
// ------------------------------------------

// GET /api/reservations - Mengambil seluruh data reservasi
Route::get('/reservations', function () {
    return response()->json([
        "status" => true,
        "message" => "List reservasi",
        "data" => [
            [
                "id" => 1, 
                "user" => "Azzam", 
                "room_id" => 101, 
                "check_in" => "2026-04-20", 
                "check_out" => "2026-04-22"
            ]
        ]
    ], 200);
});

// GET /api/reservations/{id} - Mengambil reservasi berdasarkan ID
Route::get('/reservations/{id}', function ($id) {
    return response()->json([
        "status" => true,
        "message" => "Detail reservasi ID $id",
        "data" => [
            "id" => $id, 
            "user" => "Azzam", 
            "room_id" => 101, 
            "check_in" => "2026-04-20", 
            "check_out" => "2026-04-22"
        ]
    ], 200);
});

// GET /api/users/{user_id}/reservations - Reservasi milik user tertentu
Route::get('/users/{user_id}/reservations', function ($user_id) {
    return response()->json([
        "status" => true,
        "message" => "Reservasi milik user ID $user_id",
        "data" => [
            ["id" => 1, "room_id" => 101, "check_in" => "2026-04-20", "check_out" => "2026-04-22"]
        ]
    ], 200);
});

// POST /api/reservations - Membuat reservasi baru
Route::post('/reservations', function (Request $request) {
    return response()->json([
        "status" => true,
        "message" => "Reservasi berhasil dibuat"
    ], 201);
});

// PUT /api/reservations/{id} - Update data reservasi
Route::put('/reservations/{id}', function (Request $request, $id) {
    return response()->json([
        "status" => true,
        "message" => "Reservasi ID $id berhasil diupdate"
    ], 200);
});

// DELETE /api/reservations/{id} - Hapus/cancel reservasi
Route::delete('/reservations/{id}', function ($id) {
    return response()->json([
        "status" => true,
        "message" => "Reservasi ID $id berhasil dibatalkan"
    ], 200);
});
