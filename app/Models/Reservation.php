<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;
use App\Models\User;
use ApiPlatform\Metadata\ApiResource;

#[ApiResource]
class Reservation extends Model
{
    protected $fillable = [
        'customer_name',
        'customer_email',
        'customer_phone',
        'date',
        'checkin',
        'checkout',
        'amount',
        'invoice_number',
        'booking_source',
        'payment_status',
        'number_of_children',
        'number_of_adults',
        'comment',
        'status',
        'user_id',
        'product_id',
        'product_type',
    ];


    protected $casts = [
        'date' => 'datetime',
        'checkin' => 'datetime',
        'checkout' => 'datetime',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->morphTo();
    }
}
