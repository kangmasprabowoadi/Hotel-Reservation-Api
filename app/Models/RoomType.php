<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    protected $fillable = ['name', 'description', 'price_per_night', 'image'];

    public function reservations() {
        return $this->hasMany(Reservation::class);
    }
}
