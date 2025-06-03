<?php

namespace App\Http\Controllers\Api;

use App\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\CardType;
use Illuminate\Http\Request;

class MembershipController extends Controller
{
    public function __construct(public ApiResponse $apiResponse) {}
    public function getByMembershipName($name) {
        $membershipType = CardType::where("card_name", $name)->first();
        return $this->apiResponse->success("Membership has been fetched", $membershipType);
    }
}
