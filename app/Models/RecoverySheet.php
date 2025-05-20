<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class RecoverySheet extends Model
{
    protected $table = "recovery_sheets";
    protected $guarded = [ "id", "created_at", "updated_at" ];
    public function member() {
        return $this->belongsTo(Member::class);
    }
}
