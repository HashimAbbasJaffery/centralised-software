<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
    protected $guarded = [ "id", "created_at", "updated_at" ];
    public function member() {
        return $this->belongsTo(Member::class);
    }

    public function membership() {
        return $this->belongsTo(CardType::class, "membership_id");
    }
}
