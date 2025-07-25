<?php

namespace App\Http\Controllers\Api;

use App\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FamilySheetController extends Controller
{
    public function __construct(protected ApiResponse $apiResponse) {}
    public function get(Member $member) {
        if(!$member->has_receipt_created) {
            return $this->apiResponse->error(404, "Family Sheet has not been created yet!");
        }

        $filename = $member->member_name . "-" . $member->id . ".pdf";

        $file = Storage::disk("public")->path("members/FamilySheet/$filename");
        
        return response()->download($file);
    }
}