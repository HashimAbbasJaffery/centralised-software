<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CardType extends Model
{
    protected $guarded = [ "id", "created_at", "updated_at" ];

    public function scopeFilter($query) {
        $keyword = request()->keyword;

        $query->whereLike("card_name", "%$keyword%")
                ->whereLike("card_color", "%$keyword%")
                ->whereLike("shade_color", "%$keyword%");

        return $query;
    }
}
