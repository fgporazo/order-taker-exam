<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'date_of_delivery',
        'status',
        'amount_due',
        'date_created',
        'created_by',
        'timestamp',
        'user_id'
    ];
    public $timestamps = false;
    
    public function items(){
        return $this->hasMany(PurchaseItem::class,'purchase_order_id','id');
    }
    public function customer(){
        return $this->hasOne(Customer::class,'id','customer_id');
    }
}
