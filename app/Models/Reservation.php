<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use App\Models\Room;
// use App\Models\Customer;
use App\Models\User;
use App\Models\Product;
use ApiPlatform\Metadata\ApiResource;

#[ApiResource]
class Reservation extends Model
{
    protected $fillable = [
        'id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'date',
        'checkin',
        'checkout',
        'amount',
        'invoice',
        'booking_source',
        'payment_status',
        'number_of_children',
        'number_of_adults',
        'room_id',
        'comment',
        'status',
        'activity_id',
        'menu_id',
        'user_id',
        'product_id',
    ];

    protected $casts = [
        'date' => 'datetime',
        'checkin' => 'datetime',
        'checkout' => 'datetime',
    ];

    // public function room()
    // {
    //     return $this->belongsTo(Room::class);
    // }

    // public function activity()
    // {
    //     return $this->belongsTo(Activity::class);
    // }

    // public function menu()
    // {
    //     return $this->belongsTo(Menu::class);
    // }

    // public function customer()
    // {
    //     return $this->belongsTo(Customer::class);
    // }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
