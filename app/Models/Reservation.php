<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Service;
use App\Models\Customer;

class Reservation extends Model
{
    use HasFactory;
    protected $table = 'reservation';
    protected $primaryKey = 'reservation_id';

    protected $fillable = [
        'reservation_code',
        'customer_id',
        'service_id',
    ];
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    protected $casts = [
        'reservation_time' => 'datetime',
    ];
}
