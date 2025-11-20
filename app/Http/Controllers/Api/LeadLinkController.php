<?php

namespace App\Http\Controllers\Api;

use App\ApiResponse;
use App\Models\LeadLink;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\LeadLinkResource;
use Illuminate\Support\Facades\Validator;

class LeadLinkController extends Controller
{

    public function __construct(protected ApiResponse $apiResponse)
    {
        $this->middleware("auth:sanctum")->except(['markUsed']);;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $keyword = request()->keyword;
        $leadLinks = LeadLink::where("lead_name", "like", "%{$keyword}%")
            ->orWhere('phone_number', 'like', "%{$keyword}%")
            ->paginate(8)
        ;

        return LeadLinkResource::collection($leadLinks);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make(request()->all(), [
            'lead_name' => 'required|string|max:255',
            'county_code' => 'required|string|max:5',
            'phone_number' => 'required|string|max:50',
        ]);


        if ($validator->fails()) {
            $this->apiResponse->error(422, $validator->errors());
        }

        $token = Str::random(32);

        $link = LeadLink::create([
            'lead_name' => $validator->validated()['lead_name'],
            'county_code' => $validator->validated()['county_code'],
            'phone_number' => $validator->validated()['phone_number'],
            'token' => $token,
            'expires_at' => now()->addHours(26),
            'status' => 'active'
        ]);

        return $this->apiResponse->success("Lead Link has been created!");
    }

    public function markUsed(LeadLink $id)
    {
        if ($id->status === 'active') {
            $id->status = 'used';
            $id->save();
        }

        return $this->apiResponse->success("Lead is marked as used");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
