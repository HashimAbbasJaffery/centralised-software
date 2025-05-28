<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complain extends Model
{
    public function member() {
        return $this->belongsTo(Member::class);
    }

    public function complainQuestion() {
        return $this->belongsTo(ComplainQuestion::class, "question_id");
    }
}
