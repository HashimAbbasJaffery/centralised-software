<?php

namespace App\Models;

use App\Http\Requests\MemberRequest;
use App\Jobs\CreateFamilySheet;
use App\Jobs\SaveInGoogleDrive;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Request;

class Member extends Model
{
    use SoftDeletes;
    protected $guarded = [ "id", "created_at", "updated_at" ];
    protected $casts = [
        "has_receipt_created" => "boolean"
    ];
    protected $with = [ "membership" ];
    public function spouses() {
        return $this->hasMany(Spouse::class);
    }
    public function children() {
        return $this->hasMany(Child::class);
    }
    public function membership() {
        return $this->belongsTo(CardType::class, "membership_type");
    }
    public function recovery() {
        return $this->hasMany(RecoverySheet::class);
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
    public function receipts() {
        return $this->hasMany(Receipt::class);
    }
    public static function booted() {
        static::creating(function($member) {
            if(empty($member->user_token)) {
                $member->user_token = Str::uuid();
            }
        });

        static::created(function($member) {
            dispatch(new SaveInGoogleDrive());
            dispatch(new CreateFamilySheet($member));
        });

        static::updated(function($member) {
            dispatch(new SaveInGoogleDrive());
            dispatch(new CreateFamilySheet($member));
        });
    }
    public function profession() {
        return $this->hasOne(Profession::class);
    }
    public function attachProfession(MemberRequest $request) {
         $this->profession()->create([
            ...$request->validated(),
            "designation" => $request->company_designation,
            "type_of_profession" => $request->profession,
        ]);
    }
    public function attachSpouses($spouses) {
        if(!count($spouses)) return;
        foreach($spouses as $spouse) {
            $directory = "uploads/spouses_picture";

            // If user doesn't submit via input file, it will add the previous data from the database
            Log::info($spouse);
            if(gettype($spouse["profile_pic"]) !== "object" && $spouse["profile_pic"]) {
                // It will only work while updating data
                $fileName = $spouse["profile_pic"];
            } else if(gettype($spouse["profile_pic"]) === "string"){
                $fileName = $spouse["name"] . "_" . time() . "." . $spouse["profile_pic"]->extension();
                Storage::disk("public")->putFileAs($directory, $spouse["profile_pic"], $fileName);
                $fileName = $directory . "/" . $fileName;
            } else {
                $fileName = "profile_pictures/default-user.png";
            }
            $this->spouses()->create([
                "spouse_name" => $spouse["name"],
                "cnic" => $spouse["cnic"],
                "date_of_birth" => $spouse["date_of_birth"],
                "date_of_issue" => $spouse["date_of_issue"],
                "validity" => $spouse["validity"],
                "blood_group" => $spouse["blood_group"],
                "picture" => $fileName
            ]);
        }
    }
    public function attachChildren($children) {
        if(!count($children)) return;
        foreach($children as $child) {
            Log::info($children);
            $directory = "uploads/children_pictures";
            if(gettype($child["profile_pic"]) !== "object" && $child["profile_pic"]) {
                $fileName = $child["profile_pic"];
            } else if(gettype($child["profile_pic"]) === "string"){
                $fileName = $child["name"] . "_" . time() . "." . $child["profile_pic"]->extension();
                Storage::disk("public")->putFileAs($directory, $child["profile_pic"], $fileName);
                $fileName = $directory . "/" . $fileName;
            } else {
                $fileName = "profile_pictures/default-user.png";
            }
            $this->children()->create([
                "child_name" => $child["name"],
                "date_of_birth" => $child["date_of_birth"],
                "cnic" => $child["cnic"],
                "date_of_issue" => $child["date_of_issue"],
                "validity" => $child["validity"],
                "blood_group" => $child["blood_group"],
                "profile_pic" => $fileName,
                "membership_id" => $child["card_id"]
            ]);
        }
    }
    public function introletter() {
        return $this->hasOne(Introletter::class);
    }
}
