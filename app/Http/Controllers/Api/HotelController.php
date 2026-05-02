<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RoomType;
use App\Models\Reservation;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    // API untuk ambil daftar kamar (tampil di Android)
    public function getRooms()
    {
        $rooms = RoomType::all();
        return response()->json([
            'success' => true,
            'data' => $rooms
        ]);
    }

    // API untuk kirim reservasi dari Android
    public function storeReservation(Request $request)
    {
        $request->validate([
            'room_type_id' => 'required',
            'customer_name' => 'required',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
        ]);

        $reservation = Reservation::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Reservasi di Amanjiwo Berhasil!',
            'data' => $reservation
        ]);
    }
}