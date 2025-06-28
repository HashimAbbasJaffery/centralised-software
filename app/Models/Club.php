<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    protected $guarded = [ "id", "created_at", "updated_at" ];
    public function introletters() {
        return $this->hasMany(Introletter::class);
    }
}
