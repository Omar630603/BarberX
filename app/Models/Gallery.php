<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;
    protected $table = 'gallery';
    protected $primaryKey = 'gallery_id';

    protected $fillable = [
        'category_service_id',
        'image',
    ];
}
