<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'tenant_id',
        'slot_id',
        'user_id',
        'status',
        'quantity',
        'meta',
        'booked_at'
    ];

    protected $casts = [
        'meta' => 'array',
        'booked_at' => 'datetime',
    ];

    public function slot()
    {
        return $this->belongsTo(Slot::class, 'slot_id');
    }

    public function user()
    {
        return $this->belongsTo(Admin::class, 'user_id');
    }

    public function tenant()
    {
        return $this->belongsTo(Admin::class, 'tenant_id');
    }
}
