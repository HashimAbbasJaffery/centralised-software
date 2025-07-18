<?php

namespace App\Http\Controllers\Api;

use App\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\MemberRequest;
use App\Http\Resources\MemberResource;
use App\Models\Member;
use App\Models\PersonalAccessToken;
use App\Preprocess\CleanMemberRequest;
use App\Service\UserService;
use App\Services\ImageService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;

class MemberController extends Controller
{
    public function __construct(public ApiResponse $apiResponse, public ImageService $imageService, protected UserService $user) {
        $this->middleware("auth:sanctum");
    }
    public function getById(Member $member) {
        return $member;
    }
    public function index() {
        $this->user->isAllowedToPerformAction("member:manage");

        $member = Member::filter()->orderBy("created_at", "desc")->paginate(8)->withQueryString();
        return MemberResource::collection($member);
    }
    public function store(MemberRequest $request) {
        $this->user->isAllowedToPerformAction("member:add");

        [$children, $spouses, $phone_numbers] = app(CleanMemberRequest::class)->clean($request);

        Log::info($spouses);

        $filePath = "profile_pictures/default-user.png";
        if(request()->hasFile("profile_picture")) {
            $filePath = $this->imageService->upload(request()->file("profile_picture"));
        }
        
        DB::transaction(function() use($request, $phone_numbers, $filePath, $spouses, $children){

            $member = Member::create([
                ...$request->validated(),
                "profile_picture" => $filePath,
                "city" => $request->member_city,
                "country" => $request->member_country,
                "phone_number" => $phone_numbers[0]->phoneNumber,
                "phone_number_code" => $phone_numbers[0]->countryCode,
                "alternate_ph_number" => $phone_numbers[1]->phoneNumber,
                "alternate_ph_number_code" => $phone_numbers[1]->countryCode,
                "emergency_contact" => $phone_numbers[2]->phoneNumber,
                "emergency_contact_code" => $phone_numbers[2]->countryCode
            ]);

            $member->attachProfession($request);
            $member->attachSpouses($spouses);
            $member->attachChildren($children);


        });

        return $this->apiResponse->success(
            message: "Member has been created successfully!"
        );
    }
    public function destroy(Member $member) {
        $member->delete();
        return $this->apiResponse->success("Member has been deleted!");
    }
    public function update(MemberRequest $request, Member $member) {
        Log::info($request);
        [$children, $spouses, $phone_numbers] = app(CleanMemberRequest::class)->clean($request);

        $filePath = $member->profile_picture;
        if(request()->hasFile("profile_picture")) {
            $filePath = $this->imageService->upload(request()->file("profile_picture"));
        }
        $data = [
            ...$request->validated(),
            "city" => $request->member_city,
            "country" => $request->member_country,
            "profile_picture" => $filePath,
            "phone_number" => $phone_numbers[0]->phoneNumber,
            "phone_number_code" => $phone_numbers[0]->countryCode,
            "alternate_ph_number" => $phone_numbers[1]->phoneNumber,
            "alternate_ph_number_code" => $phone_numbers[1]->countryCode,
            "emergency_contact" => $phone_numbers[2]->phoneNumber,
            "emergency_contact_code" => $phone_numbers[2]->countryCode,
        ];
        DB::transaction(function() use ($data, $request, $spouses, $children, $member) {
            $member->update($data);
            $member->attachProfession($request);

            $member->spouses()->delete();
            $member->attachSpouses($spouses);

            $member->children()->delete();
            $member->attachChildren($children);
        });

        return $this->apiResponse->success(
            message: "Member has been updated successfully!"
        );
    }
    public function getAll() {
        $members = Member::orderByDesc("created_at")->get();

        return MemberResource::collection($members);
    }
    public function getAllMembers() {
        $members = Member::whereNotIn("payment_status", [ "level4", "level3" ])->get();

        return MemberResource::collection($members);
    }
}
