<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComplainQuestion extends Model
{
    protected $guarded = [ "id", "created_at", "updated_at" ];
    public function complainType() {
        return $this->belongsTo(ComplainType::class, "complain_type_id");
    }
}
