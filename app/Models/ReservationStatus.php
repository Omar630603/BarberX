<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationStatus extends Model
{
    use HasFactory;
    protected $table = 'reservation_status';
    protected $primaryKey = 'reservation_status_id';

    protected $fillable = [
        'reservation_code',
        'status',
        'price',
    ];
}
