<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'full_name',
        'city',
        'is_active',
        'mobile_number',
        'date_created',
        'created_by',
        'timestamp',
        'user_id'
    ];
    public $timestamps = false;

}
