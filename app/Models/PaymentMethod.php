<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    protected $guarded = [ "id", "created_at", "updated_at" ];
    public function receipt() {
        return $this->hasMany(Receipt::class);
    }
}
