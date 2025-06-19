<?php

namespace App\Http\Controllers\Api\Members;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberRecoverySheetController extends Controller
{
    public function get(Member $member) {
        return view("MembersEnd.index");
    }
}
