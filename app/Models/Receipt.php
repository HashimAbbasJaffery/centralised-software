<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    protected $guarded = [ "id", "created_at", "updated_at" ];

    public function member() {
        return $this->belongsTo(Member::class);
    }
    public function payment_method() {
        return $this->belongsTo(PaymentMethod::class, "payment_method_id");
    }
}
