<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    public function receipt() {
        return $this->hasMany(Receipt::class);
    }
}
