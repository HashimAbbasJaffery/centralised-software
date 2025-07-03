<?php

namespace App\Http\Controllers\Members;

use App\Http\Controllers\Controller;
use App\Models\CardType;
use App\Models\Member;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function GuzzleHttp\json_encode;

class MemberController extends Controller
{
    public function index() {
        $setting = Setting::first();
        return view("Members.index", compact("setting"));
    }
    public function create() {
        return view("Members.create");
    }
    public function update(Member $member) {
        $spouses = $member->spouses;
        $children = $member->children()->select(["id", DB::raw("child_name as childName"), DB::raw("date_of_birth as dob")])->get();
        
        $child_id = 0;

        if(count($children) > 0) {
            $children = $member->children->map(function ($child, $index) {
                return [
                    'id' => $index + 1, // or use $child->id if you want DB ID
                    'childName' => $child->child_name ?? '',
                    'dob' => $child->date_of_birth ?? '',
                ];
            });
        } else {
            $children = [["id" => 1, "childName" => "", "dob" => ""]];
        }

        $spouse_array = [];
        foreach($spouses as $spouse) {
            $spouse_array[][] = $spouse->spouse_name;
        }
       
        return view("Members.update", compact("member", "spouse_array", "children"));
    }
    public function getDetails(Member $member) {
        $memberships = CardType::all();
        $childMemberships = CardType::whereIn("card_name", ["child", "temporary", "permanent"])->get();
        return view("Members.member_detail", compact("member", "memberships", "childMemberships"));
    }
}
