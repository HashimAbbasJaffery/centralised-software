<?php

namespace App\Http\Controllers\Api;

use App\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\IntroletterResource;
use App\Models\Introletter;
use App\Models\Member;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class IntroletterController extends Controller
{
    public function __construct(protected ApiResponse $apiResponse) {
        $this->middleware("auth:sanctum");
    }
    public function index() {
    $keyword = str_replace(['%', '_'], ['\%', '\_'], request()->keyword);
    $introletters = Introletter::query()
                    ->where(function ($query) use ($keyword) {
                        $query->whereHas('member', function ($q) use ($keyword) {
                            $q->where('member_name', 'like', "%$keyword%")
                            ->orWhere('membership_number', 'like', "%$keyword%");
                        })
                        ->orWhereHas('club', function ($q) use ($keyword) {
                            $q->where('club_name', 'like', "%$keyword%");
                        })
                        ->orWhereHas('duration', function ($q) use ($keyword) {
                            $q->where('months', 'like', "%$keyword%");
                        })
                        ->orWhere('spouse', 'like', "%$keyword%")
                        ->orWhere('children', 'like', "%$keyword%");
                    })
                    ->orderByDesc("created_at")
                    ->paginate(8);

        return IntroletterResource::collection($introletters);
    }

    public function delete(Introletter $introletter) {
        if(!$introletter->exists()) throw new ModelNotFoundException("Introduction Letter not found!");

        $introletter->delete();

        return $this->apiResponse->success("Introduction letter has been deleted");
    }
}
