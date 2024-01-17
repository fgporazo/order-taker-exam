<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'skus';
    protected $fillable = [
        'name',
        'code',
        'unit_price',
        'is_active',
        'image',
        'date_created',
        'created_by',
        'timestamp',
        'user_id'
    ];
    public $timestamps = false;
}
