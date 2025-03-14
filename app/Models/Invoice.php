<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use ApiPlatform\Metadata\ApiResource;

#[ApiResource]
class Invoice extends Model
{
    protected $fillable = [
        'invoice_number',
        'amount',
        'issue_date',
        'due_date',
        'status',
        'customer_id',
        'reservation_id',
    ];

    protected $casts = [
        'issue_date' => 'datetime',
        'due_date' => 'datetime',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}
