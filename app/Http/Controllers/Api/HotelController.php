<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RoomType;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class HotelController extends Controller
{
    public function getRooms()
    {
        $rooms = RoomType::all();

        return response()->json([
            'success' => true,
            'message' => 'Data kamar berhasil diambil',
            'data'    => $rooms
        ], 200);
    }

    public function storeReservation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'room_type_id'   => 'required|exists:room_types,id',
            'customer_name'  => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'check_in'       => 'required|date|after_or_equal:today',
            'check_out'      => 'required|date|after:check_in',
        ], [
            'room_type_id.required'   => 'Tipe kamar wajib dipilih.',
            'room_type_id.exists'     => 'Tipe kamar tidak ditemukan.',
            'customer_name.required'  => 'Nama tamu wajib diisi.',
            'customer_email.required' => 'Email wajib diisi.',
            'customer_email.email'    => 'Format email tidak valid.',
            'check_in.required'       => 'Tanggal check-in wajib diisi.',
            'check_in.after_or_equal' => 'Check-in tidak boleh sebelum hari ini.',
            'check_out.required'      => 'Tanggal check-out wajib diisi.',
            'check_out.after'         => 'Check-out harus setelah check-in.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors'  => $validator->errors()
            ], 422);
        }

        // Ambil data kamar
        $room = RoomType::find($request->room_type_id);

        // Hitung jumlah malam & total harga
        $checkIn    = Carbon::parse($request->check_in);
        $checkOut   = Carbon::parse($request->check_out);
        $nights     = $checkIn->diffInDays($checkOut);
        $totalPrice = $nights * $room->price_per_night;

        // Simpan reservasi dengan total_price
        $reservation = Reservation::create([
            'room_type_id'   => $request->room_type_id,
            'customer_name'  => $request->customer_name,
            'customer_email' => $request->customer_email,
            'check_in'       => $request->check_in,
            'check_out'      => $request->check_out,
            'total_price'    => $totalPrice,  
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Reservasi di Amanjiwo Berhasil!',
            'data'    => [
                'reservation' => $reservation,
                'room'        => $room->name,
                'nights'      => $nights,
                'total_price' => $totalPrice,
            ]
        ], 201);
    }
}