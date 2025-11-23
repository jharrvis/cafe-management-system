<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'user_id',
        'status',
        'total_amount',
        'payment_method',
        'ordered_at',
        'processed_at',
        'ready_at',
        'completed_at',
        'is_cancelled',
        'cancellation_reason',
        'cancelled_at',
    ];

    protected $casts = [
        'ordered_at' => 'datetime',
        'processed_at' => 'datetime',
        'ready_at' => 'datetime',
        'completed_at' => 'datetime',
        'cancelled_at' => 'datetime',
        'is_cancelled' => 'boolean',
    ];

    // Relationship with user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with order items
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Relationship with products through order items
    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_items')
                    ->withPivot('quantity', 'price', 'subtotal')
                    ->withTimestamps();
    }

    // Generate unique order number
    public static function generateOrderNumber(): string
    {
        return 'ORD-' . date('Ymd') . '-' . str_pad(static::whereDate('created_at', today())->count() + 1, 4, '0', STR_PAD_LEFT);
    }

    // Status helper methods
    public function isPending(): bool
    {
        return $this->status === 'menunggu';
    }

    public function isProcessing(): bool
    {
        return $this->status === 'diproses';
    }

    public function isReady(): bool
    {
        return $this->status === 'siap_diambil'; // Kita tetap gunakan 'siap_diambil' sebagai status internal karena itu adalah status dalam database
    }

    public function isCompleted(): bool
    {
        return $this->status === 'selesai';
    }

    // Get status badge color
    public function getStatusBadgeColor(): string
    {
        return match($this->status) {
            'menunggu' => 'yellow',
            'diproses' => 'blue',
            'siap_diambil' => 'green',  // Warna tetap hijau karena ini adalah status 'ready' secara makna
            'selesai' => 'gray',
            default => 'gray',
        };
    }

    // Get status label
    public function getStatusLabel(): string
    {
        return match($this->status) {
            'menunggu' => 'Menunggu',
            'diproses' => 'Diproses',
            'siap_diambil' => 'Siap Diantar',
            'selesai' => 'Selesai',
            default => 'Unknown',
        };
    }
}