<?php

namespace App\Http\Controllers\Api;

use App\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\MemberRequest;
use App\Http\Resources\MemberResource;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function __construct(public ApiResponse $apiResponse) {}
    public function index() {
        $member = Member::filter()->paginate(8);
        return MemberResource::collection($member);
    }
    public function store(MemberRequest $request) {
        $member = Member::create($request->validated());

        return $this->apiResponse->success(
            message: "Member has been created successfully!"
        );
    }
    public function destroy(Member $member) {
        $member->delete();
        return $this->apiResponse->success("Member has been deleted!");
    }
}
