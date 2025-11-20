<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeadLink extends Model
{
    protected $fillable = [
        'lead_name',
        'county_code',
        'phone_number',
        'email',
        'token',
        'expires_at',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'expires_at' => 'datetime',
        ];
    }

    public function isExpired(): bool
    {
        return $this->expires_at ? $this->expires_at->isPast() : false;
    }

    public function markExpired()
    {
        $this->status = 'expired';
        $this->save();
    }
}
