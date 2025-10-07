<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Slot extends Model
{
    protected $fillable = [
        'tenant_id','title','start_at','end_at','capacity','buffer_minutes','notes','active'
    ];

    protected $dates = ['start_at','end_at'];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function availableCount(): int
    {
        return max(0, $this->capacity - $this->bookings()->where('status','confirmed')->count());
    }

    public function isAvailable(int $quantity = 1): bool
    {
        return $this->availableCount() >= $quantity && $this->active;
    }

    // Scope to tenant
    public function scopeForTenant(Builder $q, $tenantId)
    {
        return $q->where('tenant_id', $tenantId);
    }
}
