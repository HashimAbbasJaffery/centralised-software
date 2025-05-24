<?php

namespace App\Http\Controllers\Members;

use App\Http\Controllers\Controller;
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
        
        $spouse_array = [];
        foreach($spouses as $spouse) {
            $spouse_array[][] = $spouse->spouse_name;
        }

        return view("Members.update", compact("member", "spouse_array", "children"));
    }
}
