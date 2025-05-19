<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecoverySheet extends Model
{
    protected $table = "recovery_sheets";
    protected $guarded = [ "id", "created_at", "updated_at" ];
    public function member() {
        return $this->belongsTo(Member::class);
    }
}
