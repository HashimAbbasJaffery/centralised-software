<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Spouse extends Model
{
    protected $table = "spouse";
    protected $guarded = ["id", "created_at", "updated_at"];
    public function member() {
        return $this->belongsTo(Member::class);
    }
}
