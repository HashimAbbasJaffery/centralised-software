<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    public function spouse() {
        return $this->hasMany(Spouse::class);
    }
    public function children() {
        return $this->hasMany(Child::class);
    }
}
