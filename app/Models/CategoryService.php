<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryService extends Model
{
    use HasFactory;
    protected $table = 'category_service';
    protected $primaryKey = 'category_service_id';

    protected $fillable = [
        'name',
        'image',
    ];
}
