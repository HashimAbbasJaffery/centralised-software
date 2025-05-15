<?php

namespace App\Http\Controllers\Api;

use App\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\MemberRequest;
use App\Http\Resources\MemberResource;
use App\Models\Member;
use App\Services\ImageService;
use App\UploadImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use function PHPUnit\Framework\isNull;

class MemberController extends Controller
{
    public function __construct(public ApiResponse $apiResponse, public ImageService $imageService) {}
    public function index() {
        $member = Member::filter()->orderBy("created_at", "desc")->paginate(8);
        return MemberResource::collection($member);
    }
    public function store(MemberRequest $request) {
        $spouses = collect(request()->spouses)->filter()->values();
        $children = request()->children;
        $phone_numbers = json_decode(request()->phone_numbers);
        
        $filePath = $this->imageService->upload(request()->file("profile_picture"));
        
        $member = Member::create([ 
                                                ...$request->validated(), 
                                                "profile_picture" => $filePath, 
                                                "phone_number" => $phone_numbers[0]->phoneNumber,
                                                "phone_number_code" => $phone_numbers[0]->countryCode,
                                                "alternate_ph_number" => $phone_numbers[1]->phoneNumber,
                                                "alternate_ph_number_code" => $phone_numbers[1]->countryCode,
                                                "emergency_contact" => $phone_numbers[2]->phoneNumber,
                                                "emergency_contact_code" => $phone_numbers[2]->countryCode
                                            ]);

        foreach($spouses as $spouse) {
            $member->spouses()->create([
                "spouse_name" => $spouse
            ]);
        }

        foreach($children as $child) {
            if (in_array(null, $child, true)) {
                continue;
            }
            $member->children()->create([
                "child_name" => $child[0],
                "date_of_birth" => $child[1]
            ]);
        }

        return $this->apiResponse->success(
            message: "Member has been created successfully!"
        );
    }
    public function destroy(Member $member) {
        $member->delete();
        return $this->apiResponse->success("Member has been deleted!");
    }
    public function update(MemberRequest $request, Member $member) {
        $spouses = collect(request()->spouses)->filter()->values();
        $children = request()->children;
        $phone_numbers = json_decode(request()->phone_numbers);
        
        $filePath = $this->imageService->upload(request()->file("profile_picture"));
        
        $member->update([ 
            ...$request->validated(), 
            "profile_picture" => $filePath, 
            "phone_number" => $phone_numbers[0]->phoneNumber,
            "phone_number_code" => $phone_numbers[0]->countryCode,
            "alternate_ph_number" => $phone_numbers[1]->phoneNumber,
            "alternate_ph_number_code" => $phone_numbers[1]->countryCode,
            "emergency_contact" => $phone_numbers[2]->phoneNumber,
            "emergency_contact_code" => $phone_numbers[2]->countryCode
        ]);

        $member->spouses()->delete();
        foreach($spouses as $spouse) {
            $member->spouses()->create([
                "spouse_name" => $spouse
            ]);
        }

        $member->children()->delete();
        foreach($children as $child) {
            $member->children()->create([
                "child_name" => $child[0],
                "date_of_birth" => $child[1]
            ]);
        }

        return $this->apiResponse->success(
            message: "Member has been updated successfully!"
        );
    }
}
