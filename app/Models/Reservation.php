<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $table = 'reservation';
    protected $primaryKey = 'reservation_id';

    protected $fillable = [
        'reservation_code',
        'customer_id',
        'service_id',
        'reservation_time',
    ];
}
