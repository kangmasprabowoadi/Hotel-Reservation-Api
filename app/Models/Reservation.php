<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = ['room_type_id', 'customer_name', 'customer_email', 'check_in', 'check_out', 'total_price'];

    public function roomType() {
        return $this->belongsTo(RoomType::class);
    }
}
