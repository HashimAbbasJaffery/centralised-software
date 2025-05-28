<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComplainType extends Model
{
    protected $guarded = [ "id", "created_at", "updated_at" ];

    public function questions() {
        return $this->hasMany(ComplainQuestion::class, "complain_type_id");
    }
}
