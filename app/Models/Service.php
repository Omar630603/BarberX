<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $table = 'service';
    protected $primaryKey = 'service_id';

    protected $fillable = [
        'category_service_id',
        'name',
        'price',
        'image',
    ];
}
