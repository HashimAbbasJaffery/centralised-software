<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Spouse extends Model
{
    public function member() {
        return $this->belongsTo(Member::class);
    }
}
