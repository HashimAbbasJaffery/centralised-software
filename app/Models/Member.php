<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Request;

class Member extends Model
{
    use SoftDeletes;
    protected $guarded = [ "id", "created_at", "updated_at" ];
    public function spouses() {
        return $this->hasMany(Spouse::class);
    }
    public function children() {
        return $this->hasMany(Child::class);
    }
    public function scopeFilter($query) {
        $keyword = request()->keyword;
        $query->where(function($query) use($keyword) {
            $query->whereLike("member_name", "%$keyword%")
                    ->orWhereLike("membership_number", "%$keyword%");
        });

        return $query;
    }
    protected function phoneNumber(): Attribute {
        return Attribute::make(
            get: fn($value) => "+$value",
            set: fn($value) => str_replace("+", "", $value)
        );
    }
    protected function alternatePhNumber(): Attribute {
        return Attribute::make(
            get: fn($value) => "+$value",
            set: fn($value) => str_replace("+", "", $value)
        );
    }
    protected function emergencyContact(): Attribute {
        return Attribute::make(
            get: fn($value) => "+$value",
            set: fn($value) => str_replace("+", "", $value)
        );
    }
}
