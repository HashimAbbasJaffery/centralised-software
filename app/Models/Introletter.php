<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Introletter extends Model
{
    protected $guarded = [ "id", "created_at", "updated_at" ];
    protected $table = "intro_letter";
    public function member() {
        return $this->belongsTo(Member::class);
    }
    public function club() {
        return $this->belongsTo(Club::class);
    }
    public function duration() {
        return $this->belongsTo(Duration::class);
    }
}
