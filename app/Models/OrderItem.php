<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    protected $table = 'order_items'; // Đảm bảo rằng mô hình sử dụng đúng bảng
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
        'created_at',
        'updated_at'
    ];

    

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
