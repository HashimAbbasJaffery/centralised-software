<?php

namespace App\Http\Controllers\Api\Members;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MemberRecoverySheetController extends Controller
{
    public function get(Member $member) {
        return view("MembersEnd.index");
    }
    public function download(Member $member) {
        $file = "recovery_" . $member->id . ".pdf";

        if(!Storage::disk("local")->exists("pdfs/$file")) {
            return;
        }

        $fullPath = Storage::disk("local")->path("pdfs/$file");
       
        return response()->download($fullPath);
    }
}
