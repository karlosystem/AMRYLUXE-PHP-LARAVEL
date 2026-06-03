<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_number',

        // Billing
        'billing_name',
        'billing_email',
        'billing_phone',
        'billing_street_address',
        'billing_district',
        'billing_province',
        'billing_zipcode',
        'billing_departament',

        // Shipping
        'shipping_name',
        'shipping_email',
        'shipping_phone',
        'shipping_street_address',
        'shipping_district',
        'shipping_province',
        'shipping_zipcode',
        'shipping_departament',

        // Order
        'subtotal',
        'shipping_cost',
        'tax',
        'discount',
        'total_amount',

        // Payment
        'payment_method',
        'payment_status',

        'coupon_code',
        'discounted_amount',
        'tax_amount',
        'shipping_amount',
        'subtotal_amount',

        // Tracking / Status
        'tracking_number',
        'order_status',
        'notes',
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
