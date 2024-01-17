<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'purchase_order_id',
        'SKU_ID',
        'quantity',
        'price',
        'timestamp',
        'user_id'
    ];
    public $timestamps = false;
}
